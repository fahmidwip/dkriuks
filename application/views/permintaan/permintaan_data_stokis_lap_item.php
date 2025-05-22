<?php
function tgl_indo1($tanggal) {
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $pecahkan = explode(' ', $tanggal);
    $tgl = explode('-', $pecahkan[0]);

    return $tgl[2] . ' - ' . $bulan[(int)$tgl[1]] . ' - ' . $tgl[0];
}
?>
<style>
.box {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  background-color: #fff;
  padding: 20px;
}
  </style>


<section class="content-header">
  <h1>
    Permintaan Stokis Berdasarkan Item
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Laporan Berdasarkan Item</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

<form method="GET" action="<?= site_url('permintaan/export_excel_pisah3') ?>" class="form-inline" target="_blank">
    <div class="form-group">
        <label for="start_date">Dari Tanggal:</label>
        <input type="date" name="start_date" id="start_date" class="form-control" required onchange="formatTanggal(this)">
        
    </div>
    <div class="form-group">
        <label for="end_date">Sampai Tanggal:</label>
        <input type="date" name="end_date" id="end_date" class="form-control" required onchange="formatTanggal(this)">
        
    </div>
    <button type="submit" class="btn btn-success">
        <i class="fa fa-file-excel-o"></i> Export ke Excel
    </button>
</form>
<br>


<div class="box">
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example1">
        <thead>
          <tr>
            <th>No</th>
            <th>Item</th>
            <th>Pemesan</th>
            <th>Stokis</th>
            <th>Status</th>
            <th>Tanggal Pesan</th>
            <th>Total</th>
            
          </tr>
        </thead>
        <?php
// Mengelompokkan data berdasarkan kode_pesanan
$grouped_data = [];
foreach ($rows_tl_sum as $data) {
    if (!isset($grouped_data[$data->nama_produk])) {
        $grouped_data[$data->nama_produk] = [
            'nama_produk' => $data->nama_produk,
            'user' => $data->user,
            'status' => $data->status,
            'statusnya' => $data->statusnya,
            'tanggal' => $data->tanggal,
            'total_harga' => 0,
            'details' => [] // Untuk menampung detail per item
        ];
    }
    // Menjumlahkan harga_item untuk kode_pesanan yang sama
    $grouped_data[$data->nama_produk]['total_harga'] += $data->jumlah;
    $grouped_data[$data->nama_produk]['details'][] = $data;
}
?>

<tbody>
    <?php
    $no = 1;
    foreach ($grouped_data as $group) :
        // Ambil data pertama dari group untuk ditampilkan (misalnya user, stokis_nama, dll)
        $data = $group['details'][0];
    ?>
        <tr>
            <td style="width:5%;"><?= $no++ ?></td>
            <td style="width:21%;"><?= $group['nama_produk'] ?></td>
            <td><?= $data->user ?></td>
            <td><?= $data->stokis_nama ?></td>
            <td>
                <?php if ($data->status != 7): ?>
                    <?php if ($data->status == 6): ?>
                        <span class="label label-success pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                    <?php elseif ($data->status == 3): ?>
                        <span class="label label-danger pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                    <?php elseif ($data->status == 5): ?>
                        <span class="label label-primary pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
            
            <td style="width:15%;"><?= tgl_indo1($data->tanggal) ?></td>
            <td><strong><?= number_format($group['total_harga'], 0, ',', '.') ?> Pcs</strong></td>

            
        </tr>
    <?php endforeach; ?>
</tbody>

      </table>
    </div>
  </div>

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
    $('#example1').DataTable();
  });
  
</script>
<script>
function formatTanggal(input) {
    const bulanIndo = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    let tanggal = input.value;
    if (!tanggal) return;

    let pecah = tanggal.split('-');
    let tahun = pecah[0];
    let bulan = bulanIndo[parseInt(pecah[1], 10) - 1];
    let hari = pecah[2];

    let hasil = `${hari} ${bulan} ${tahun}`;

   
    document.getElementById(input.id + '_display').innerText = hasil;
}
</script>
