<section class="content-header">
      <h1>
        Tambah
        <small>Pelanggan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class = "box">
            <div class = "box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Pelanggan</h3>
            <div class="col card-hader text-right">
                <a href="<?=site_url('supplier')?>" class="btn btn-warning btn-flat">
                   <i class="fa fa-undo"></i>  Kembali
                </a>
        </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <form action="<?=site_url('cust/process')?>" method="post">
              <div class="form-group">
                  <label>Nama Pelanggan *</label>
                  <input type="hidden" name="id" value="<?=$row->cust_id?>">
                  <input type="text" name="namacustomer_form" class="form-control" value="<?=$row->name?>" required>
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <label>Nomor Telepon *</label>
                  <input type="number" name="nomor_form" class="form-control" value="<?=$row->phone?>" required>
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <label>Alamat *</label>
                  <textarea name="alamats_form" class="form-control" required><?=$row->alamat?></textarea>
                  <span class="help-block"></span>
                </div>
                <div>
                <label>Gender </label>
                  <select name="gender_form" class="form-control" requierd>
                    <option value="">== Pilih ==</option>
                    <option value="L" <?=$row->gender == 'L' ? "selected" : null?>>Laki-Laki</option>
                    <option value="P" <?=$row->gender == 'P' ? "selected" : null?>>Perempuan</option>
                  </select>
                  <span class="help-block"></span>
                </div>

                <div class="form-group has-error">
                    <button type="submit" class="btn btn-success btn-flat" name="<?=$page?>">
                      <i class="fa fa-paper-plane"></i> Simpan</button>
                    <button type="reset" class="btn btn-success bg-red">
                    <i class="fa fa-undo"></i> Reset</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      
    </section>