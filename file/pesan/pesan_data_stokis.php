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

<section class="content-header">
  <h1>
    Pesan
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pesan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

  <div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
      <h3 class="box-title">Pesanan Proses</h3>
      
    </div>

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Mitra</th>
            <th>Stokis</th>
            <th>Status</th>
            <th>Tanggal Pesan</th>
            <th style="width:10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($rows as $data): ?>
          <tr>
            <td style="width:5%;"><?= $no++ ?></td>
            <td><?= $data->kode_pesanan ?></td>
            <td><?= $data->user ?></td>
            <td><?= $data->stokis_nama ?></td>
            <td><?php if ($data->status != 3): ?>
                                <?php if ($data->status == 2): ?>
                                    <span class="label label-danger pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php elseif ($data->status == 4): ?>
                                    <span class="label label-primary pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php elseif ($data->status == 1): ?>
                                    <span class="label label-danger pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php endif; ?>
                            <?php endif; ?></td>
            <td><?= tgl_indo1($data->tanggal) ?></td>
            <td class="text-center" width="250px">
              
  <a href="<?= site_url('pesan/lh_tl/'.$data->id_pesan) ?>" class="btn btn-success btn-xs">
    <i class="fa fa-eye"></i> Lihat
  </a>
</td>

          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  
  <div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
      <h3 class="box-title">Pesanan Sudah diProses</h3>
      
    </div>

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example1">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Mitra</th>
            <th>Stokis</th>
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
            <td><?php if ($data->status != 1): ?>
                                <?php if ($data->status == 2): ?>
                                    <span class="label label-success pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php elseif ($data->status == 3): ?>
                                    <span class="label label-danger pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php elseif ($data->status == 4): ?>
                                    <span class="label label-primary pull-left"><small><?= ucfirst($data->statusnya) ?></small></span>
                                <?php endif; ?>
                            <?php endif; ?></td>
            <td><?= tgl_indo1($data->tanggal) ?></td>
            <td class="text-center">
            <?php if (in_array($data->status, [2])): ?>
              <a href="<?= site_url('pesan/lh_sl/'.$data->id_pesan) ?>" class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i> Lihat
              </a>
              <?php endif; ?>
              <?php if ($data->status == 4): ?>
              <a href="<?= site_url('pesan/lh_sl_l/'.$data->id_pesan) ?>" class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i> Lihat
              </a>
              <?php endif; ?>
              <?php if ($data->status == 3): ?>
              <a href="<?= site_url('pesan/lh_sl_l/'.$data->id_pesan) ?>" class="btn btn-success btn-xs">
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
