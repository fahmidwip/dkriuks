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
    Permintaan Stokis Berdasarkan PO
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Laporan Berdasarkan PO</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<form method="GET" action="<?= site_url('permintaan/export_excel_pisah_khusus') ?>" class="form-inline" target="_blank">
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
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

  
    
  <div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
      <h3 class="box-title">Permintaan Stok Sudah diProses</h3>
      
    </div>

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example1">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Stokis</th>
            <th>Logistik</th>
            <th>Status</th>
            <th>Tanggal Pesan</th>
            <th style="width:10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($rows_tl as $data): ?>
          <tr>
            <td style="width:5%;"><?= $no++ ?></td>
            <td><?= $data->kode_pesanan ?></td>
            <td><?= $data->user ?></td>
            <td><?= $data->stokis_nama ?></td>
            <td><?php if ($data->status != 7): ?>
                                <?php if ($data->status == 6): ?>
                                    <span class="label label-success pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php elseif ($data->status == 3): ?>
                                    <span class="label label-danger pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php elseif ($data->status == 5): ?>
                                    <span class="label label-primary pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php endif; ?>
                            <?php endif; ?></td>
            <td><?= tgl_indo1($data->tanggal) ?></td>
            <td class="text-center">
            <?php if (in_array($data->status, [6])): ?>
              <a href="<?= site_url('permintaan/lh_sl/'.$data->id_pesan) ?>" class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i> Lihat
              </a>
              <?php endif; ?>
              <?php if ($data->status == 5): ?>
              <a href="<?= site_url('permintaan/lh_sl_l/'.$data->id_pesan) ?>" class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i> Lihat
              </a>
              <?php endif; ?>
              <?php if ($data->status == 3): ?>
              <a href="<?= site_url('permintaan/lh_sl_l/'.$data->id_pesan) ?>" class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i> Lihat
              </a>
              <?php endif; ?>
            </td>

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
