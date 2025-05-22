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
          <form action="<?= base_url('user/editin') ?>" method="post">
            <input type="hidden" name="user_id" value="<?= $row->user_id ?>">

            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama_form" value="<?= $this->input->post('nama_form') ?? $row->name ?>" class="form-control" placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-group">
              <label>Username</label>
              <input type="text" name="user_form" value="<?= $this->input->post('user_form') ?? $row->username ?>" class="form-control" placeholder="Masukkan username">
            </div>

            <div class="form-group">
              <label>Password <small>(Kosongkan jika tidak diubah)</small></label>
              <input type="password" name="password_form" value="<?= $this->input->post('password_form') ?>" class="form-control" placeholder="********">
            </div>

            <div class="form-group">
              <label for="stokis_form">Stokis <span class="text-danger">*</span></label>
              <small>(Stokis yang sudah terdipilih sebelumnya = <strong><?= $this->input->post('user_form') ?? $row->stokis_name ?></strong>)</small>
              <select name="stokis_form" id="stokis_form" class="form-control">
                <option value="">== Pilih ==</option>
                <?php foreach ($stokis as $s): ?>
                  <option value="<?= $s->id_stokis ?>" 
  <?= strval(set_value('stokis_form', $row->id_stokis ?? '')) == strval($s->id_stokis) ? 'selected' : '' ?>>
  <?= $s->nama_stokis ?>
</option>
                <?php endforeach; ?>
              </select>
            </div>


            <div class="form-group">
              <label>Level</label>
              <select name="level_form" id="level_form" class="form-control">
                <option value="">== Pilih ==</option>
                <?php foreach ($level as $l): ?>
                  <option value="<?= $l->id_level ?>" <?= $row->level == $l->id_level ? 'selected' : '' ?>>
                    <?= $l->level ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Provinsi</label>
              <select name="provinsi_form" id="provinsi_form" class="form-control">
                <option value="">== Pilih ==</option>
                <?php foreach ($provinsi as $p): ?>
                  <option value="<?= $p->id_prov ?>" <?= $row->provinsi == $p->id_prov ? 'selected' : '' ?>>
                    <?= $p->provinsi ?>
                  </option>
                <?php endforeach; ?>
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
