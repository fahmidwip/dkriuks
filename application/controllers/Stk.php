<?php 

// Memastikan autoload Composer dari PhpSpreadsheet di load dengan benar
require_once FCPATH . 'vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memuat model yang diperlukan
        $this->load->model('pesan_m');
        $this->load->model('harga_m');
        $this->load->model('user_m');
        $this->load->model('keranjang_model');
        // Memuat library yang diperlukan
        $this->load->library('form_validation');
        $this->load->library('session');
    }	
	public function index(){
		$data['row'] = $this->harga_m->get3();
		$this->template->load('template', 'permintaan/permintaan_tambah3',$data);
}

public function input() {
    $user_id = $this->session->userdata('userid');

if (!$user_id) {
    redirect('login');
    return;
}

// Ambil nama user (stokis) dari tabel 'user'
$this->db->where('user_id', $user_id); // GANTI jika nama kolomnya berbeda
$user_row = $this->db->get('user')->row();

if (!$user_row) {
    $this->session->set_flashdata('error', 'Data user tidak ditemukan.');
    redirect('pesan');
    return;
}

$logistik = $user_row->logistik; // ambil nama dari user sebagai stokis

$barang_ids = $this->input->post('id_harga');
$barang_stok = $this->input->post('id_stok');
$pcs_values = $this->input->post('pcs');

// Validasi input
if (
    !is_array($barang_ids) || 
    !is_array($barang_stok) || 
    !is_array($pcs_values) || 
    count($barang_ids) !== count($pcs_values) || 
    count($barang_ids) !== count($barang_stok)
) {
    $this->session->set_flashdata('error', 'Data input tidak valid.');
    redirect('pesan');
    return;
}

// Buat kode pesanan & data header pesan
$kode_pesanan = 'ORD' . date('YmdHis') . 'USR' . $user_id;
$data_pesan = [
    'pemesan' => $user_id,
    'kode_pesanan' => $kode_pesanan,
    'status' => 7,
    'stokis' => $logistik,
    'catatan' => 5,
    'tanggal' => date('Y-m-d H:i:s')
];

// Simpan ke tabel pesan
$this->pesan_m->add($data_pesan);
$id_pesan = $this->db->insert_id();

$total_semua = 0;

// Simpan detail pesan
foreach ($barang_ids as $index => $id_barang) {
    $jumlah = (int)$pcs_values[$index];
    $id_stok = $barang_stok[$index]; // Ambil nilai stok berdasarkan indeks yang sama

    if ($jumlah > 0) {
        $barang = $this->harga_m->getBarangById($id_barang);
        $user_table = $this->user_m->getBarangById($user_id); // perbaikan variabel

        if ($barang && $user_table) {
            $nama_item = $barang->nama_produk;
            $harga_mitra = $barang->harga_mitra;
            $logistik = $user_table->logistik;
            $harga_total = $jumlah * $harga_mitra;

            $data_detail = [
                'pesan_id' => $id_pesan,
                'user_id' => $user_id,
                'barang_id' => $id_barang,
                'jenis_id' => $id_stok, // simpan id_stok jika dibutuhkan
                'stokis' => $logistik,
                'jumlah' => $jumlah,
                'harga_total' => $harga_total,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->harga_m->add($data_detail);
            $total_semua += $harga_total;
        }
    }
}

    echo "Total Semua: " . rupiah($total_semua);
    $this->session->set_flashdata('success', 'Data berhasil disimpan!');
    redirect('permintaan');
}

public function lh($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->template->load('template', 'permintaan/permintaan_detail', $data);
}
public function lh_tl($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); 
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->template->load('template', 'permintaan/permintaan_detail_tl', $data);
}
public function lh_sl($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->template->load('template', 'permintaan/permintaan_detail_sl', $data);
}
public function lh_sl_l($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->template->load('template', 'permintaan/permintaan_detail_sl_l', $data);
}
public function pesanan() {
    check_logistik();
    $user_id = $this->fungsi->user_login()->stokis;
    $data['row'] = $this->harga_m->get2();
    $data['rows'] = $this->pesan_m->stokis2($user_id);
    $data['rows_tl'] = $this->pesan_m->stokis_tl2($user_id);
    $this->template->load('template','permintaan/permintaan_data_stokis', $data);
}
public function del($id){
	$this->pesan_m->delete($id);
    $this->keranjang_model->delete($id);
	$this->session->set_flashdata('danger', 'Data berhasil dihapus.');
	redirect(base_url('pesan'));
}
public function ed($id)
{
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);
    $pesan1 = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan,
        'pesan1' => $pesan1
    );

    $this->template->load('template', 'pesan/pesan_edit', $data);
}

public function editin()
{
    $id_pesan = $this->input->post('id_pesan');
    $catatan_mitra = $this->input->post('catatan_mitra');
	$status = 5;
    $dataupdate = array (
		'status' => $status,
        'catatan' => $catatan_mitra
    );
    $this->pesan_m->edit_pesan($dataupdate,$id_pesan);
	$this->session->set_flashdata('success', 'Data berhasil dikirim.');
	redirect(base_url('permintaan'));
}
public function editin_tl() 
{
    $id_pesan = $this->input->post('id_pesan');
    $catatan_stokis = $this->input->post('catatan_stokis');
    $id_harga = $this->input->post('id_harga'); 
    $id_stok = $this->input->post('id_stok'); 
    $jumlah = $this->input->post('jumlah'); 
    $status = 6;

    $data_pesan = array(
        'status' => $status,
        'catatan_stokis' => $catatan_stokis
    );

    $success = true;

    if ($status == 6) {
        foreach ($id_stok as $key => $value) {
            $stok_gudang = $this->harga_m->get_stok_by_id1($value); // stok gudang
            $stok_stokis = $this->harga_m->get_stok_by_id5($value); // stok milik stokis
            $jumlah_diminta = $jumlah[$key];

            // Validasi stok mencukupi di gudang
            if (
                ($stok_gudang !== null && $stok_gudang >= $jumlah_diminta) ||
                ($stok_stokis !== null && $stok_stokis >= $jumlah_diminta)
            ) {
                // Update stok gudang
                $stok_baru_gudang = $stok_gudang - $jumlah_diminta;
                $stok_baru_stokis = $stok_stokis + $jumlah_diminta;

                $data_stok = array(
                    'stok1' => $stok_baru_gudang,
                    'stok' => $stok_baru_stokis
                );

                $this->harga_m->edit_stok1($data_stok, $value);
            } else {
                $this->session->set_flashdata('error', '<strong>Stok tidak mencukupi. Harap cek kembali dan hubungi logistik.</strong>');
                $success = false;
                break;
            }
        }

        if ($success) {
            $this->pesan_m->edit_pesan($data_pesan, $id_pesan);
            $this->session->set_flashdata('success', 'Data berhasil dikirim.');
        }
    }

    redirect(base_url('permintaan/pesanan'));
}

public function editin_tl1() 
{
    $id_pesan = $this->input->post('id_pesan');
    $catatan_stokis = $this->input->post('catatan_stokis');
    $id_harga = $this->input->post('id_harga'); 
    $jumlah = $this->input->post('jumlah'); 
    $status = 2;
    $data_pesan = array(
        'status' => $status,
        'catatan_stokis' => $catatan_stokis
    );
    if ($status == 2) {
        $success = true; 
        foreach ($id_harga as $key => $value) {
            $stok_lama = $this->harga_m->get_stok_by_id($value);
            if ($stok_lama !== null && $stok_lama >= $jumlah[$key]) {
                $stok_total = $stok_lama - $jumlah[$key];
                $data_stok = array(
                    'stok' => $stok_total
                );
                $this->harga_m->edit_stok($data_stok, $value);
            } else {
                $this->session->set_flashdata('error', '<strong>Ada stok tidak mencukupi harap cek kembali dan hubungi logistik</strong>');
                $success = false;
                break;
            }
        }
        if ($success) {
            $this->pesan_m->edit_pesan($data_pesan, $id_pesan);
            $this->session->set_flashdata('success', 'Data berhasil dikirim.');
        }
    }

    if ($success) {
        redirect(base_url('pesan/pesanan'));
    } else {
        redirect(base_url('pesan/pesanan'));
    }
}


public function pr($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->load->view('pesan/cetak', $data);
}
public function pr1($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->load->view('pesan/cetak_struk', $data);
}

public function editin_tl_batal()
{
    $id_pesan = $this->input->post('id_pesan');
    $catatan_batal = $this->input->post('catatan_batal');
	$status = 3;
    $dataupdate = array (
		'status' => $status,
        'catatan_stokis' => $catatan_batal
    );
    $this->pesan_m->edit_pesan($dataupdate,$id_pesan);
	$this->session->set_flashdata('success', 'Data berhasil dikirim.');
	redirect(base_url('pesan/pesanan'));
}
public function export_excel() 
{
    $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');

    // Ambil data pesanan
    $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->where('DATE(tanggal) >=', $start_date);
    $this->db->where('DATE(tanggal) <=', $end_date);
    $this->db->where_in('pesan.status', [2]);
    $this->db->where('pesan.stokis', $user_id);
    $this->db->order_by('pesan.id_pesan', 'asc');

    $query = $this->db->get();
    $data = $query->result();

    // Membuat objek Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menentukan header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Kode Pesanan');
    $sheet->setCellValue('C1', 'Pemesan');
    $sheet->setCellValue('D1', 'Stokis');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Produk');
    $sheet->setCellValue('G1', 'Tanggal Pesan');
    $sheet->setCellValue('H1', 'Jumlah Transaksi');

    $no = 1;
    $row = 2;
    $hargasemua = 0;

    foreach ($data as $d) {
        // Ambil semua produk dan total harga untuk pesanan ini
        $this->db->select('harg.nama_produk, keranjang.harga_total');
        $this->db->from('keranjang');
        $this->db->join('harg', 'harg.id_harga = keranjang.barang_id');
        $this->db->where('keranjang.pesan_id', $d->id_pesan);
        $items = $this->db->get()->result();

        $nama_produk = [];
        $total_harga = 0;
        foreach ($items as $item) {
            $nama_produk[] = $item->nama_produk;
            $total_harga += $item->harga_total; // jumlahkan semua harga_total untuk id_pesan ini
        }

        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $d->kode_pesanan);
        $sheet->setCellValue('C' . $row, $d->user);
        $sheet->setCellValue('D' . $row, $d->stokis_nama);
        $sheet->setCellValue('E' . $row, $d->statusnya);
        $sheet->setCellValue('F' . $row, implode(', ', $nama_produk));
        $sheet->setCellValue('G' . $row, $d->tanggal);
        $sheet->setCellValue('H' . $row, $total_harga); // harga hasil penjumlahan

        $hargasemua += $total_harga;
        $row++;
    }


    // Output ke browser
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Data_Pesanan_' . $start_date . '_to_' . $end_date . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}

public function export_excel1() 
{
    $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');

    // Ambil data pesanan
    $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->where('DATE(tanggal) >=', $start_date);
    $this->db->where('DATE(tanggal) <=', $end_date);
    $this->db->where_in('pesan.status', [2]);
    $this->db->order_by('pesan.id_pesan', 'asc');

    $query = $this->db->get();
    $data = $query->result();

    // Membuat objek Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menentukan header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Kode Pesanan');
    $sheet->setCellValue('C1', 'Pemesan');
    $sheet->setCellValue('D1', 'Stokis');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Produk');
    $sheet->setCellValue('G1', 'Tanggal Pesan');
    $sheet->setCellValue('H1', 'Jumlah Transaksi');

    $no = 1;
    $row = 2;
    $hargasemua = 0;

    foreach ($data as $d) {
        // Ambil semua produk dan total harga untuk pesanan ini
        $this->db->select('harg.nama_produk, keranjang.harga_total');
        $this->db->from('keranjang');
        $this->db->join('harg', 'harg.id_harga = keranjang.barang_id');
        $this->db->where('keranjang.pesan_id', $d->id_pesan);
        $items = $this->db->get()->result();

        $nama_produk = [];
        $total_harga = 0;
        foreach ($items as $item) {
            $nama_produk[] = $item->nama_produk;
            $total_harga += $item->harga_total; // jumlahkan semua harga_total untuk id_pesan ini
        }

        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $d->kode_pesanan);
        $sheet->setCellValue('C' . $row, $d->user);
        $sheet->setCellValue('D' . $row, $d->stokis_nama);
        $sheet->setCellValue('E' . $row, $d->statusnya);
        $sheet->setCellValue('F' . $row, implode(', ', $nama_produk));
        $sheet->setCellValue('G' . $row, $d->tanggal);
        $sheet->setCellValue('H' . $row, $total_harga); // harga hasil penjumlahan

        $hargasemua += $total_harga;
        $row++;
    }


    // Output ke browser
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Data_Pesanan_' . $start_date . '_to_' . $end_date . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}

function get_filtered_data($start_date, $end_date) {
    // Misalnya menggunakan model untuk mengambil data berdasarkan tanggal
    return $this->db->where('tanggal >=', $start_date)
                    ->where('tanggal <=', $end_date)
                    ->get('pesanan')
                    ->result();
}
}