<section class="content-header">
  <h1>
    Daftar
    <small>Harga</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Harga</li>
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
    <?php if ($this->session->flashdata('danger')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('danger'); ?></div>
    <?php endif; ?>

  <div class="mb-3 text-right">
    <a href="<?= site_url('harga/tambah') ?>" class="btn btn-primary btn-flat">
      <i class="fa fa-dollar"></i> + Buat Harga
    </a>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Harga</h3>
    </div>

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Harga Jual</th>
            <th>Harga Jual Mitra</th> 
            <th>Provinsi</th>            
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($row)): $no = 1; foreach ($row as $data): ?>
            <tr>
              <td style="width:5%;"><?= $no++ ?></td>
              <td><?= $data->nama_item ?></td>
              <td><?= rupiah($data->harga_jual) ?></td>
              <td><?= rupiah($data->harga_jual_mitra) ?></td>
              <td><?= $data->provinsi_name ?></td>
              <td class="text-center" width="160px">
                <a href="<?= site_url('harga/ed/'.$data->id_harga) ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="<?= site_url('harga/del/'.$data->id_harga) ?>" onclick="return confirm('Yakin menghapus data?')" class="btn btn-danger btn-xs">
                  <i class="fa fa-trash"></i> Hapus
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
