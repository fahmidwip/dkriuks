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

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Jumlah Stok</th>            
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($row)): $no = 1; foreach ($row as $data): ?>
            <tr>
              <td style="width:5%;"><?= $no++ ?></td>
              <td><?= $data->nama_item ?></td>
              <td><?= $data->stok ?> Pcs</td>
              <td class="text-center" width="160px">
                <a href="<?= site_url('stok/up/'.$data->id_harga) ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-edit "></i> Update Stok
                </a>
              </td>
            </tr>
          <?php endforeach; else: ?>
            <tr>
              <td colspan="4" class="text-center">Data tidak tersedia.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</section>
