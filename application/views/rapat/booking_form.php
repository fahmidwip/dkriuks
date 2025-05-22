<section class="content-header">
      <h1>
        Booking
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Tambah Booking</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class = "box">
            <div class = "box-header">
            <h3 class="box-title"> Data Pengguna Baru</h3>
            <div class="col card-hader text-right">
                <a href="<?=site_url('dashboard')?>" class="btn btn-warning btn-flat">
                   <i class="fa fa-undo"></i>  Kembali
                </a>
        </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <form action="<?=site_url('dashboard/tambah')?>" method="post">
              <div class="form-group">
                  <label>Ruang Rapat *</label>
                  <select name="ruang_rapat" class="form-control">
                    <option value="Ruang Rapat 1" selected>Ruang Rapat 1</option>
                    <option value="Ruang Rapat 2">Ruang Rapat 2</option>
                    <option value="Ruang Rapat 3">Ruang Rapat 3</option>
                    <option value="Ruang Rapat 4">Ruang Rapat 4</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Mulai Rapat *</label>
                  <input type="text" name="mulai" class="form-control">
                </div>
                <div class="form-group">
                  <label>Durasi *</label>
                  <input type="text" name="durasi" class="form-control">
                </div>
                <div class="form-group">
                  <label>Tanggal Acara *</label>
                  <input type="date" name="tanggal" class="form-control">
                </div>
                <div class="form-group">
                  <label>Perihal Acara *</label>
                  <input type="text" name="perihal" class="form-control">
                </div>
                <div class="form-group has-error">
                    <button type="submit" class="btn btn-success btn-flat">
                      <i class="fa fa-paper-plane"></i> Simpan</button>
                    <button type="reset" class="btn btn-success bg-red">
                    <i class="fa fa-undo"></i> Reset</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      
    </section>