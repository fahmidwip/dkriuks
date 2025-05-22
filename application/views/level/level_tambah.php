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
    Tambah
    <small>Provinsi</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Tambah Level</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Provinsi Baru</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form action="<?= base_url('level/input') ?>" method="post">
            <div class="form-group">
              <label>Level *</label>
              <input type="text" name="level" class="form-control" required>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success btn-flat">
                <i class="fa fa-paper-plane"></i> Simpan
              </button>
              <button type="reset" class="btn btn-danger btn-flat">
                <i class="fa fa-undo"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
