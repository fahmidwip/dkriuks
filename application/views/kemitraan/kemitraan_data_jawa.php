<section class="content-header">
  <h1>
    Daftar
    <small>Mitra WITA</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kemitraan</li>
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
      <h3 class="box-title">Data Mitra</h3>
    </div>

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Mitra</th>
            <th>Alamat</th>
            <th>Type</th>
            <th>Status</th>            
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($user_jawa)): $no = 1; foreach ($user_jawa as $data): ?>
            <tr>
              <td style="width:5%;"><?= $no++ ?></td>
              <td><?= $data->name ?></td>
              <td><?= $data->alamat ?></td>
              <td><?= $data->keterangan ?></td>
              <td><?= $data->status ?></td>
              <td class="text-center" style="width:5%;">
                <a href="<?= site_url('kemitraan/up/'.$data->user_id) ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-pencil"></i> Update
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
