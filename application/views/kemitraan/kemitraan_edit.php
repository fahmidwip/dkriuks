<section class="content-header">
  <h1>Edit <small>User</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">User Edit</li>
  </ol>
</section>

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

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Form Edit Pengguna</h3>
    </div>
    
    <div class="box-body">
      <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
          <form action="<?= base_url('kemitraan/editin') ?>" method="post">
            <input type="hidden" name="user_id" value="<?= $user->user_id ?>">


            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama_form" value="<?= $this->input->post('nama_form') ?? $user->name ?>" class="form-control" placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat_form" class="form-control" placeholder="Masukkan alamat lengkap"><?= $this->input->post('alamat_form') ?? $user->alamat ?></textarea>
            </div>

            <div class="form-group">
    <label>Type</label>
    <select name="type_form" class="form-control">
        <?php
        $selected_value = $this->input->post('type_form') ?? $user->type;
        ?>
        <option value="3" <?= $selected_value == 3 ? 'selected' : '' ?>>Mitra</option>
        <option value="4" <?= $selected_value == 4 ? 'selected' : '' ?>>Holding</option>
        <option value="7" <?= $selected_value == 7 ? 'selected' : '' ?>>Mandiri</option>
    </select>
</div>


<div class="form-group">
    <label>Status</label>
    <select name="status_form" class="form-control">
    <option value="5" <?= ($this->input->post('status_form') ?? $user->aktif) == 5 ? 'selected' : '' ?>>Yes</option>
    <option value="6" <?= ($this->input->post('status_form') ?? $user->aktif) == 6 ? 'selected' : '' ?>>No</option>
</select>

</div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-success">
                <i class="fa fa-paper-plane"></i> Simpan
              </button>
              <button type="reset" class="btn btn-danger">
                <i class="fa fa-undo"></i> Reset
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>
