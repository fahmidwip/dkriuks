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
  <h1>Ubah <small>Password</small></h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Ubah Password</li>
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
      <h3 class="box-title">Form Ubah Password</h3>
    </div>
    
    <div class="box-body">
      <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
          <form action="<?= base_url('user/editin1') ?>" method="post">
            <input type="hidden" name="user_id" value="<?= $row->user_id ?>">

            <div class="form-group">
              <label>Password <small>(Kosongkan jika tidak diubah)</small></label>
              <input type="password" name="password_form" value="<?= $this->input->post('password_form') ?>" class="form-control" placeholder="********">
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
