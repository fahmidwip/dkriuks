<?php
function tgl_indo1($tanggal) {
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $pecahkan = explode(' ', $tanggal);
    $tgl = explode('-', $pecahkan[0]);

    if (count($tgl) < 3) {
        return $tanggal; // fallback jika format tidak sesuai
    }

    return $tgl[2] . ' - ' . $bulan[(int)$tgl[1]] . ' - ' . $tgl[0];
}

function tgl_indo($tanggal) {
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $pecahkan = explode(' ', $tanggal);
    $tgl = explode('-', $pecahkan[0]);

    if (count($tgl) < 3) {
        return $tanggal; // fallback jika format tidak sesuai
    }

    $waktu = isset($pecahkan[1]) ? $pecahkan[1] : '';

    return $tgl[2] . ' - ' . $bulan[(int)$tgl[1]] . ' - ' . $tgl[0] . ($waktu ? ' Jam ' . $waktu : '');
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
    Daftar
    <small>Stok</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Stok</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('successs')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('successs'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('danger'); ?></div>
    <?php endif; ?>
  <div class="mb-3 text-right">

  </div>

  <div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Data Stok</h3>
  </div>

  <div class="box-body">
    <h4 style="color: red;">
  <strong>Harap update stok sesuai dengan permintaan PO yang sudah diajukan </strong>
  <a href="<?= site_url('permintaan/pesanan_lap_stokis') ?>" style="color: red; text-decoration: underline;">Klik di sini</a>
</h4>



    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="example">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Jumlah Stok</th>
            <th>Update Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($row)): $no = 1; foreach ($row as $data): ?>
            <tr>
              <td style="width:5%;"><?= $no++ ?></td>
              <td><?= $data->nama_produk ?></td>
              <td style="width:5%;"><strong><?= $data->stok ?> Pcs</strong></td>
              <td style="width:25%;"><?= tgl_indo($data->update_stok) ?></td>
              <td class="text-center" style="width:10%;">
                <a href="<?= site_url('stok/up1/'.$data->id_stok) ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-edit "></i> Update Stok
                </a>
              </td>
            </tr>
          <?php endforeach; else: ?>
            <tr>
              <td colspan="5" class="text-center">Data tidak tersedia.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</section>
