<?php 

// Memastikan autoload Composer dari PhpSpreadsheet di load dengan benar
require_once FCPATH . 'vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pesan extends CI_Controller {

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
    }	public function index()
	{
        check_mitra(); 
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->pesan_m->get();
        $data['row_tl'] = $this->pesan_m->get_tl();
		$this->template->load('template','pesan/pesan_data', $data);
	}

	public function tambah(){
		$data['row'] = $this->harga_m->get3();
		$this->template->load('template', 'pesan/pesan_tambah2',$data);
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

$stokis = $user_row->stokis; // ambil nama dari user sebagai stokis

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
    'status' => 1,
    'stokis' => $stokis,
    'catatan' => 3,
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
            $stokis = $user_table->stokis;
            $harga_total = $jumlah * $harga_mitra;

            $data_detail = [
                'pesan_id' => $id_pesan,
                'user_id' => $user_id,
                'barang_id' => $id_barang,
                'jenis_id' => $id_stok, // simpan id_stok jika dibutuhkan
                'stokis' => $stokis,
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
    redirect('pesan');
}

public function lh($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->template->load('template', 'pesan/pesan_detail', $data);
}
public function lh_tl($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); 
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->template->load('template', 'pesan/pesan_detail_tl', $data);
}
public function lh_sl($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->template->load('template', 'pesan/pesan_detail_sl', $data);
}
public function lh_sl_l($id) {
    $keranjang = $this->keranjang_model->getByPesanId($id); // <-- ini harus return result()
    $pesan = $this->pesan_m->detail($id);

    $data = array(
        'keranjang' => $keranjang, // dipakai di foreach
        'pesan' => $pesan
    );

    $this->template->load('template', 'pesan/pesan_detail_sl_l', $data);
}
public function pesanan() {
    check_stokis();
    $user_id = $this->fungsi->user_login()->stokis;
    $data['row'] = $this->harga_m->get();
    $data['rows'] = $this->pesan_m->stokis($user_id);
    $data['rows_tl'] = $this->pesan_m->stokis_tl($user_id);
    $this->template->load('template','pesan/pesan_data_stokis', $data);
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
	$status = 4;
    $dataupdate = array (
		'status' => $status,
        'catatan' => $catatan_mitra
    );
    $this->pesan_m->edit_pesan($dataupdate,$id_pesan);
	$this->session->set_flashdata('success', 'Data berhasil dikirim.');
	redirect(base_url('pesan'));
}
public function editin_tl() 
{
    $id_pesan = $this->input->post('id_pesan');
    $catatan_stokis = $this->input->post('catatan_stokis');
    $id_harga = $this->input->post('id_harga'); 
    $id_stok = $this->input->post('id_stok'); 
    $jumlah = $this->input->post('jumlah'); 
    $status = 2;
    $data_pesan = array(
        'status' => $status,
        'catatan_stokis' => $catatan_stokis
    );
    if ($status == 2) {
        $success = true; 
        foreach ($id_stok as $key => $value) {
            $stok_lama = $this->harga_m->get_stok_by_id5($value);
            if ($stok_lama !== null && $stok_lama >= $jumlah[$key]) {
                $stok_total = $stok_lama - $jumlah[$key];
                $data_stok = array(
                    'stok' => $stok_total
                );
                $this->harga_m->edit_stok1($data_stok, $value);
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

public function export_excel_bar() 
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

public function export_excel_pisah() 
{
    $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');

    // Ambil data pesanan
    $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama
    , status.status_nama as statusnya');
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
    $sheet->setCellValue('G1', 'Qty');
    $sheet->setCellValue('H1', 'Harga Satuan');
    $sheet->setCellValue('I1', 'Tanggal Pesan');
    $sheet->setCellValue('J1', 'Jumlah Transaksi');

    $no = 1;
    $row = 2;
    $hargasemua = 0;

foreach ($data as $d) {
    // Ambil semua produk dan total harga untuk pesanan ini
    $this->db->select('harg.nama_produk, harg.harga_mitra, keranjang.harga_total, keranjang.jumlah');
    $this->db->from('keranjang');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id');
    $this->db->where('keranjang.pesan_id', $d->id_pesan);
    $items = $this->db->get()->result();

    $firstRow = true; // Flag untuk hanya mengisi data pesanan di baris pertama

    foreach ($items as $item) {
        $sheet->setCellValue('A' . $row, $firstRow ? $no : '');
        $sheet->setCellValue('B' . $row, $firstRow ? $d->kode_pesanan : '');
        $sheet->setCellValue('C' . $row, $firstRow ? $d->user : '');
        $sheet->setCellValue('D' . $row, $firstRow ? $d->stokis_nama : '');
        $sheet->setCellValue('E' . $row, $firstRow ? $d->statusnya : '');
        $sheet->setCellValue('F' . $row, $item->nama_produk);
        $sheet->setCellValue('G' . $row, $item->jumlah);
        $sheet->setCellValue('H' . $row, $item->harga_mitra);
        $sheet->setCellValue('I' . $row, $firstRow ? $d->tanggal : '');
        $sheet->setCellValue('J' . $row, $item->harga_total);

        $hargasemua += $item->harga_total;
        $firstRow = false;
        $row++;
    }

    $no++;
}


    // Menambahkan baris untuk total transaksi
    $sheet->setCellValue('I' . $row, 'Total Transaksi');
    $sheet->setCellValue('J' . $row, $hargasemua);

    // Output ke browser
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Data_Pesanan_' . $start_date . '_Sampai_' . $end_date . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}



public function export_excel_pisah_direksi_1() 
{
    $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');

    // Ambil data pesanan
    $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama
    , status.status_nama as statusnya');
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
    $sheet->setCellValue('G1', 'Qty');
    $sheet->setCellValue('H1', 'Harga Satuan');
    $sheet->setCellValue('I1', 'Tanggal Pesan');
    $sheet->setCellValue('J1', 'Jumlah Transaksi');

    $no = 1;
    $row = 2;
    $hargasemua = 0;

foreach ($data as $d) {
    // Ambil semua produk dan total harga untuk pesanan ini
    $this->db->select('harg.nama_produk, harg.harga_mitra, keranjang.harga_total, keranjang.jumlah');
    $this->db->from('keranjang');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id');
    $this->db->where('keranjang.pesan_id', $d->id_pesan);
    $items = $this->db->get()->result();

    $firstRow = true; // Flag untuk hanya mengisi data pesanan di baris pertama

    foreach ($items as $item) {
        $sheet->setCellValue('A' . $row, $firstRow ? $no : '');
        $sheet->setCellValue('B' . $row, $firstRow ? $d->kode_pesanan : '');
        $sheet->setCellValue('C' . $row, $firstRow ? $d->user : '');
        $sheet->setCellValue('D' . $row, $firstRow ? $d->stokis_nama : '');
        $sheet->setCellValue('E' . $row, $firstRow ? $d->statusnya : '');
        $sheet->setCellValue('F' . $row, $item->nama_produk);
        $sheet->setCellValue('G' . $row, $item->jumlah);
        $sheet->setCellValue('H' . $row, $item->harga_mitra);
        $sheet->setCellValue('I' . $row, $firstRow ? $d->tanggal : '');
        $sheet->setCellValue('J' . $row, $item->harga_total);

        $hargasemua += $item->harga_total;
        $firstRow = false;
        $row++;
    }

    $no++;
}


    // Menambahkan baris untuk total transaksi
    $sheet->setCellValue('I' . $row, 'Total Transaksi');
    $sheet->setCellValue('J' . $row, $hargasemua);

    // Output ke browser
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Data_Pesanan_' . $start_date . '_Sampai_' . $end_date . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}

public function export_excel_pisah3()
{
    $user_id = $this->fungsi->user_login()->stokis;
    $start_date = trim($this->input->get('start_date'));
    $end_date = trim($this->input->get('end_date'));
    $id = trim($this->input->get('id'));

    // Query data
    $this->db->select('
        pesan.*, 
        user.name AS nama_user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama_item, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk AS nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); 
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left');

    $this->db->where('pesan.status', 2);

    if (!empty($user_id)) {
        $this->db->where('pesan.stokis', $user_id);
    }

    if (!empty($id)) {
        $this->db->where('pesan.id_pesan', $id);
    }

    if (!empty($start_date) && !empty($end_date)) {
        $this->db->where('pesan.tanggal >=', $start_date);
        $this->db->where('pesan.tanggal <=', $end_date);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    $data = $query->result();

    // Kelompokkan data berdasarkan kombinasi produk + tanggal + user
    $grouped_data = [];
    foreach ($data as $row) {
        $key = $row->nama_produk . '|' . $row->tanggal . '|' . $row->nama_user;

        if (!isset($grouped_data[$key])) {
            $grouped_data[$key] = [
                'nama_produk' => $row->nama_produk,
                'user' => $row->nama_user,
                'stokis_nama' => $row->stokis_nama,
                'statusnya' => $row->statusnya,
                'tanggal' => $row->tanggal,
                'total_harga' => 0,
                'details' => []
            ];
        }

        $grouped_data[$key]['total_harga'] += $row->jumlah;
        $grouped_data[$key]['details'][] = $row;
    }

    // Buat Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Item');
    $sheet->setCellValue('C1', 'Pemesan');
    $sheet->setCellValue('D1', 'Stokis');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Tanggal Pesan');
    $sheet->setCellValue('G1', 'Total');

    // Isi Data
    $rowNumber = 2;
    $no = 1;
    foreach ($grouped_data as $group) {
        $statusLabel = ucfirst($group['statusnya']);
        $sheet->setCellValue('A' . $rowNumber, $no++);
        $sheet->setCellValue('B' . $rowNumber, $group['nama_produk']);
        $sheet->setCellValue('C' . $rowNumber, $group['user']);
        $sheet->setCellValue('D' . $rowNumber, $group['stokis_nama']);
        $sheet->setCellValue('E' . $rowNumber, $statusLabel);
        $sheet->setCellValue('F' . $rowNumber, $group['tanggal']);
        $sheet->setCellValue('G' . $rowNumber, $group['total_harga'] . ' Pcs');
        $rowNumber++;
    }

    // Export file Excel
    $filename = 'laporan_pesan_' . date('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

public function export_excel_pisah3_direk()
{
    $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $id = $this->input->get('id');

    $this->db->select('
        pesan.*, 
        user.name AS nama_user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama_item, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk AS nama_produk,
        pesan.tanggal
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); 
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left');
    $this->db->where('pesan.status', 6);

    if (!empty($id)) {
        $this->db->where('pesan.id_pesan', $id);
    }

    if (!empty($start_date) && !empty($end_date)) {
        $this->db->where('pesan.tanggal >=', $start_date);
        $this->db->where('pesan.tanggal <=', $end_date);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    $result = $query->result();

    // Kelompokkan data
    $grouped_data = [];
    foreach ($result as $data) {
        $key = $data->nama_produk . '|' . $data->tanggal . '|' . $data->nama_user;

        if (!isset($grouped_data[$key])) {
            $grouped_data[$key] = [
                'nama_produk' => $data->nama_produk,
                'user' => $data->nama_user,
                'stokis_nama' => $data->stokis_nama,
                'statusnya' => $data->statusnya,
                'tanggal' => $data->tanggal,
                'total_harga' => 0,
                'details' => []
            ];
        }

        $grouped_data[$key]['total_harga'] += $data->jumlah;
        $grouped_data[$key]['details'][] = $data;
    }

    // Buat Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Item');
    $sheet->setCellValue('C1', 'Stokis');
    $sheet->setCellValue('D1', 'Logistik');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Tanggal Pesan');
    $sheet->setCellValue('G1', 'Total');

    // Isi Data
    $rowNumber = 2;
    $no = 1;
    foreach ($grouped_data as $group) {
        $statusLabel = ucfirst($group['statusnya']);
        $sheet->setCellValue('A' . $rowNumber, $no++);
        $sheet->setCellValue('B' . $rowNumber, $group['nama_produk']);
        $sheet->setCellValue('C' . $rowNumber, $group['stokis_nama']);
        $sheet->setCellValue('D' . $rowNumber, $group['user']);
        $sheet->setCellValue('E' . $rowNumber, $statusLabel);
        $sheet->setCellValue('F' . $rowNumber, $group['tanggal']);
        $sheet->setCellValue('G' . $rowNumber, $group['total_harga'] . ' Pcs');
        $rowNumber++;
    }

    // Export file
    $filename = 'laporan_pesan_' . date('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

public function export_excel_pisah3_direk_logis()
{
    $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $id = $this->input->get('id');

    $this->db->select('
        pesan.*, 
        user.name AS nama_user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama_item, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk AS nama_produk,
        pesan.tanggal
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); 
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left');
    $this->db->where('pesan.status', 6);
    $this->db->where('pesan.stokis', $user_id);

    if (!empty($id)) {
        $this->db->where('pesan.id_pesan', $id);
    }

    if (!empty($start_date) && !empty($end_date)) {
        $this->db->where('pesan.tanggal >=', $start_date);
        $this->db->where('pesan.tanggal <=', $end_date);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    $result = $query->result();

    // Kelompokkan data
    $grouped_data = [];
    foreach ($result as $data) {
        $key = $data->nama_produk . '|' . $data->tanggal . '|' . $data->nama_user;

        if (!isset($grouped_data[$key])) {
            $grouped_data[$key] = [
                'nama_produk' => $data->nama_produk,
                'user' => $data->nama_user,
                'stokis_nama' => $data->stokis_nama,
                'statusnya' => $data->statusnya,
                'tanggal' => $data->tanggal,
                'total_harga' => 0,
                'details' => []
            ];
        }

        $grouped_data[$key]['total_harga'] += $data->jumlah;
        $grouped_data[$key]['details'][] = $data;
    }

    // Buat Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Item');
    $sheet->setCellValue('C1', 'Logistik');
    $sheet->setCellValue('D1', 'Stokis');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Tanggal Pesan');
    $sheet->setCellValue('G1', 'Total');

    // Isi Data
    $rowNumber = 2;
    $no = 1;
    foreach ($grouped_data as $group) {
        $statusLabel = ucfirst($group['statusnya']);
        $sheet->setCellValue('A' . $rowNumber, $no++);
        $sheet->setCellValue('B' . $rowNumber, $group['nama_produk']);
        $sheet->setCellValue('C' . $rowNumber, $group['stokis_nama']);
        $sheet->setCellValue('D' . $rowNumber, $group['user']);
        $sheet->setCellValue('E' . $rowNumber, $statusLabel);
        $sheet->setCellValue('F' . $rowNumber, $group['tanggal']);
        $sheet->setCellValue('G' . $rowNumber, $group['total_harga'] . ' Pcs');
        $rowNumber++;
    }

    // Export file
    $filename = 'laporan_pesan_' . date('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}


public function export_excel_pisah3_direk_stokis()
{
    $user = $this->fungsi->user_login();

  // Ambil nilai dari objek user
  
  $user_id   = isset($user->user_id) ? $user->user_id : null;
    
    $user_id1 = $this->fungsi->user_login()->user_id;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $id = $this->input->get('id');

    $this->db->select('
        pesan.*, 
        user.name AS nama_user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama_item, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk AS nama_produk,
        pesan.tanggal
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); 
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left');
    $this->db->where('pesan.pemesan', $user_id);
    
    

    if (!empty($id)) {
        $this->db->where('pesan.id_pesan', $id);
    }

    if (!empty($start_date) && !empty($end_date)) {
        $this->db->where('pesan.tanggal >=', $start_date);
        $this->db->where('pesan.tanggal <=', $end_date);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    $result = $query->result();

    // Kelompokkan data
    $grouped_data = [];
    foreach ($result as $data) {
        $key = $data->nama_produk . '|' . $data->tanggal . '|' . $data->nama_user;

        if (!isset($grouped_data[$key])) {
            $grouped_data[$key] = [
                'nama_produk' => $data->nama_produk,
                'user' => $data->nama_user,
                'stokis_nama' => $data->stokis_nama,
                'statusnya' => $data->statusnya,
                'tanggal' => $data->tanggal,
                'total_harga' => 0,
                'details' => []
            ];
        }

        $grouped_data[$key]['total_harga'] += $data->jumlah;
        $grouped_data[$key]['details'][] = $data;
    }

    // Buat Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Item');
    $sheet->setCellValue('C1', 'Logistik');
    $sheet->setCellValue('D1', 'Stokis');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Tanggal Pesan');
    $sheet->setCellValue('G1', 'Total');

    // Isi Data
    $rowNumber = 2;
    $no = 1;
    foreach ($grouped_data as $group) {
        $statusLabel = ucfirst($group['statusnya']);
        $sheet->setCellValue('A' . $rowNumber, $no++);
        $sheet->setCellValue('B' . $rowNumber, $group['nama_produk']);
        $sheet->setCellValue('C' . $rowNumber, $group['stokis_nama']);
        $sheet->setCellValue('D' . $rowNumber, $group['user']);
        $sheet->setCellValue('E' . $rowNumber, $statusLabel);
        $sheet->setCellValue('F' . $rowNumber, $group['tanggal']);
        $sheet->setCellValue('G' . $rowNumber, $group['total_harga'] . ' Pcs');
        $rowNumber++;
    }

    // Export file
    $filename = 'laporan_pesan_' . date('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}


public function export_excel_pisah3_pen()
{
    $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $id = $this->input->get('id'); // Sama seperti user_id

    $this->db->select('
        pesan.*, 
        user.name AS nama_user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama_item, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk AS nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); 
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left');

    $this->db->where('pesan.status', 2);

    if (!empty($id)) {
        $this->db->where('pesan.id_pesan', $id);
    }

    if (!empty($start_date) && !empty($end_date)) {
        $this->db->where('pesan.tanggal >=', $start_date);
        $this->db->where('pesan.tanggal <=', $end_date);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    $result = $query->result();

    // Kelompokkan data
    $grouped_data = [];
    foreach ($result as $data) {
        $key = $data->nama_produk . '|' . $data->tanggal;

        if (!isset($grouped_data[$key])) {
            $grouped_data[$key] = [
                'nama_produk' => $data->nama_produk,
                'user' => $data->nama_user,
                'stokis_nama' => $data->stokis_nama,
                'statusnya' => $data->statusnya,
                'tanggal' => $data->tanggal,
                'total_harga' => 0,
                'details' => []
            ];
        }

        $grouped_data[$key]['total_harga'] += $data->jumlah;
        $grouped_data[$key]['details'][] = $data;
    }

    // Buat Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Item');
    $sheet->setCellValue('C1', 'Stokis');
    $sheet->setCellValue('D1', 'Mitra');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Tanggal Pesan');
    $sheet->setCellValue('G1', 'Total');

    // Isi Data
    $rowNumber = 2;
    $no = 1;
    foreach ($grouped_data as $group) {
        $statusLabel = ucfirst($group['statusnya']);
        $sheet->setCellValue('A' . $rowNumber, $no++);
        $sheet->setCellValue('B' . $rowNumber, $group['nama_produk']);
        $sheet->setCellValue('C' . $rowNumber, $group['stokis_nama']);
        $sheet->setCellValue('D' . $rowNumber, $group['user']);
        $sheet->setCellValue('E' . $rowNumber, $statusLabel);
        $sheet->setCellValue('F' . $rowNumber, $group['tanggal']);
        $sheet->setCellValue('G' . $rowNumber, $group['total_harga'] . ' Pcs');
        $rowNumber++;
    }

    // Export file
    $filename = 'laporan_pesan_' . date('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}




public function export_excel_pisah4()
{   $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $id = $this->input->get('id'); // Sama seperti user_id

    $this->db->select('
        pesan.*, 
        user.name AS nama_user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama_item, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk AS nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); 
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left');

    $this->db->where('pesan.status', 2);


    if (!empty($id)) {
        $this->db->where('pesan.id_pesan', $id);
    }

    if (!empty($start_date) && !empty($end_date)) {
        $this->db->where('pesan.tanggal >=', $start_date);
        $this->db->where('pesan.tanggal <=', $end_date);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    $data = $query->result();

    // Kelompokkan data
    $grouped_data = [];
    foreach ($data as $row) {
        if (!isset($grouped_data[$row->nama_produk])) {
            $grouped_data[$row->nama_produk] = [
                'nama_produk' => $row->nama_produk,
                'user' => $row->nama_user,
                'stokis_nama' => $row->stokis_nama,
                'status' => $row->status,
                'statusnya' => $row->statusnya,
                'tanggal' => $row->tanggal,
                'total_harga' => 0
            ];
        }
        $grouped_data[$row->nama_produk]['total_harga'] += $row->jumlah;
    }

    // Buat Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Item');
    $sheet->setCellValue('C1', 'Pemesan');
    $sheet->setCellValue('D1', 'Stokis');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Tanggal Pesan');
    $sheet->setCellValue('G1', 'Total');

    // Isi Data
    $rowNumber = 2;
    $no = 1;
    foreach ($grouped_data as $group) {
        $statusLabel = ucfirst($group['statusnya']);
        $sheet->setCellValue('A' . $rowNumber, $no++);
        $sheet->setCellValue('B' . $rowNumber, $group['nama_produk']);
        $sheet->setCellValue('C' . $rowNumber, $group['user']);
        $sheet->setCellValue('D' . $rowNumber, $group['stokis_nama']);
        $sheet->setCellValue('E' . $rowNumber, $statusLabel);
        $sheet->setCellValue('F' . $rowNumber, $group['tanggal']);
        $sheet->setCellValue('G' . $rowNumber, $group['total_harga'] . ' Pcs');
        $rowNumber++;
    }

    // Export file
    $filename = 'laporan_pesan_' . date('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}


public function export_excel_pisah_direksi()
{   $user_id = $this->fungsi->user_login()->stokis;
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');
    $id = $this->input->get('id'); // Sama seperti user_id

    $this->db->select('
        pesan.*, 
        user.name AS nama_user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama_item, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk AS nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); 
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left');

    $this->db->where('pesan.status', 2);

    if (!empty($user_id)) {
        $this->db->where('pesan.stokis', $user_id);
    }

    if (!empty($id)) {
        $this->db->where('pesan.id_pesan', $id);
    }

    if (!empty($start_date) && !empty($end_date)) {
        $this->db->where('pesan.tanggal >=', $start_date);
        $this->db->where('pesan.tanggal <=', $end_date);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    $data = $query->result();

    // Kelompokkan data
    $grouped_data = [];
    foreach ($data as $row) {
        if (!isset($grouped_data[$row->nama_produk])) {
            $grouped_data[$row->nama_produk] = [
                'nama_produk' => $row->nama_produk,
                'user' => $row->nama_user,
                'stokis_nama' => $row->stokis_nama,
                'status' => $row->status,
                'statusnya' => $row->statusnya,
                'tanggal' => $row->tanggal,
                'total_harga' => 0
            ];
        }
        $grouped_data[$row->nama_produk]['total_harga'] += $row->jumlah;
    }

    // Buat Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Item');
    $sheet->setCellValue('C1', 'Pemesan');
    $sheet->setCellValue('D1', 'Stokis');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Tanggal Pesan');
    $sheet->setCellValue('G1', 'Total');

    // Isi Data
    $rowNumber = 2;
    $no = 1;
    foreach ($grouped_data as $group) {
        $statusLabel = ucfirst($group['statusnya']);
        $sheet->setCellValue('A' . $rowNumber, $no++);
        $sheet->setCellValue('B' . $rowNumber, $group['nama_produk']);
        $sheet->setCellValue('C' . $rowNumber, $group['user']);
        $sheet->setCellValue('D' . $rowNumber, $group['stokis_nama']);
        $sheet->setCellValue('E' . $rowNumber, $statusLabel);
        $sheet->setCellValue('F' . $rowNumber, $group['tanggal']);
        $sheet->setCellValue('G' . $rowNumber, $group['total_harga'] . ' Pcs');
        $rowNumber++;
    }

    // Export file
    $filename = 'laporan_pesan_' . date('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
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