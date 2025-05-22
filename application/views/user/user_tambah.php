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
    Tambah <small>User</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">User</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Form Tambah Pengguna</h3>
    </div>
    
    <div class="box-body">
      <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
          <form action="<?= base_url('user/input') ?>" method="post">

            <div class="form-group">
              <label for="nama_form">Nama <span class="text-danger">*</span></label>
              <input type="text" name="nama_form" id="nama_form" class="form-control" required placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-group">
              <label for="user_form">Username <span class="text-danger">*</span></label>
              <input type="text" name="user_form" id="user_form" class="form-control" required placeholder="Masukkan username">
            </div>

            <div class="form-group">
              <label for="password_form">Password <span class="text-danger">*</span></label>
              <input type="password" name="password_form" id="password_form" class="form-control" required placeholder="********">
            </div>

            <div class="form-group">
              <label for="stokis_form">Stokis <span class="text-danger">*</span></label>
              <select name="stokis_form" id="stokis_form" class="form-control" required>
                <option value="">== Pilih ==</option>
                <?php foreach ($stokis as $s): ?>
                  <option value="<?= $s->id_stokis ?>" <?= set_value('stokis_form') == $s->id_stokis ? 'selected' : '' ?>>
                    <?= $s->nama_stokis ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="level_form">Level <span class="text-danger">*</span></label>
              <select name="level_form" id="level_form" class="form-control" required>
                <option value="">== Pilih ==</option>
                <?php foreach ($level as $l): ?>
                  <option value="<?= $l->id_level ?>" <?= set_value('level_form') == $l->id_level ? 'selected' : '' ?>>
                    <?= $l->level ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="provinsi_form">Provinsi <span class="text-danger">*</span></label>
              <select name="provinsi_form" id="provinsi_form" class="form-control" required>
                <option value="">== Pilih ==</option>
                <?php foreach ($provinsi as $p): ?>
                  <option value="<?= $p->id_prov ?>" <?= set_value('provinsi_form') == $p->id_prov ? 'selected' : '' ?>>
                    <?= $p->provinsi ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <s class="form-group text-center">
              <button type="submit" class="btn btn-success">
                <i class="fa fa-paper-plane"></i> Simpan
              </button>
</section>       
     
