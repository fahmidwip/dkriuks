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
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<section class="content-header">
  <h1>Pesan</h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Permintaan stok</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('danger')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('danger'); ?></div>
    <?php endif; ?>
  <!-- Tabel Pesanan Baru -->
  <div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
      <h4>Pesanan Baru di Buat</h4>
      <a href="<?= site_url('permintaan/tambah1') ?>" class="btn btn-primary btn-flat">+ Tambah Stok</a>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example">
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
          <?php $no = 1; foreach ($row as $data): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $data->kode_pesanan ?></td>
            <td><?= $data->user ?></td>
            <td><?= $data->stokis_nama ?></td>
            <td>
                            <?php if ($data->status != 4): ?>
                                <?php if ($data->status == 7): ?>
                                    <span class="label label-danger pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php elseif ($data->status == 3): ?>
                                    <span class="label label-danger pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php elseif ($data->status == 1): ?>
                                    <span class="label label-danger pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
            <td><?= tgl_indo1($data->tanggal) ?></td>
            <td class="text-center" width="160px">
              <a href="<?= site_url('permintaan/lh/'.$data->id_pesan) ?>" class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i> Lihat
              </a>
              <a href="<?= site_url('permintaan/del/' . $data->id_pesan) ?>" 
                                   class="btn btn-danger btn-xs"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tabel Pesanan Selesai -->
  <div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
      <h4>Pesanan Sudah di Proses</h4>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example1">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Pemesan</th>
            <th>Stokis</th>
            <th>Status</th>
            <th>Tanggal Pesan</th>
            <th style="width:10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($row_tl as $data): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $data->kode_pesanan ?></td>
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

<!-- Include jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
    $('#example1').DataTable();
  });
</script>
