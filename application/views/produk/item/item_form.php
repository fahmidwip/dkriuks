<section class="content-header">
      <h1>
        Tambah
        <small>Kategori</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Kategori</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class = "box">
            <div class = "box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Supplier</h3>
            <div class="col card-hader text-right">
                <a href="<?=site_url('kategori')?>" class="btn btn-warning btn-flat">
                   <i class="fa fa-undo"></i>  Kembali
                </a>
        </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <?php echo form_open_multipart('item/process') ?>
              <div class="form-group">
                  <label>Barcode *</label>
                  <input type="hidden" name="id" value="<?=$row->item_id?>">
                  <input type="text" name="barcode_form" class="form-control" value="<?=$row->barcode?>" required>
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <label for="nameproduk_form">Nama Produk *</label>
                  <input type="text" name="name_form" id="nameproduk_form" class="form-control" value="<?=$row->name?>" required>
                  <span class="help-block"></span>
                </div>

                <div class="form-group">
                  <label>Kategori *</label>
                  <select name="kategori1" class="form-control" required>
                  <option value="">== Pilih ==</option>  
                  <?php foreach ($kategori->result() as $key => $data) { ?>  
                  <option value="<?=$data->category_id?>" <?=$data->category_id == $row->category_id ? "selected" : null?>><?=$data->name?></option>
                    
                   <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Unit *</label>
                  <?php echo form_dropdown('unit', $unit, $selectedunit, 
                  ['class' => 'form-control', 'required' => 'required']) ?>
                </div>

                <div class="form-group">
                  <label>Harga *</label>
                  <input type="number" name="harga_form" class="form-control" value="<?=$row->price?>" required>
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <label>File</label>
                  <?php if($page == 'edit') {
                      if($row->files != null) { ?>
                        <div style="margin-bottom:5px">
                        <img src="<?=base_url('file/'.$row->files)?>" style="width:80%">
                        </div>
                    <?php
                      }
                  } ?>
                  <input type="file" name="file_form" class="form-control">
                  <small>Biarkan kosong jika tidak <?=$page == 'edit' ? 'diganti' : 'ada' ?></small>
                </div>
                <div class="form-group has-error">
                    <button type="submit" class="btn btn-success btn-flat" name="<?=$page?>">
                      <i class="fa fa-paper-plane"></i> Simpan</button>
                    <button type="reset" class="btn btn-success bg-red">
                    <i class="fa fa-undo"></i> Reset</button>
                </div>
              <?php echo form_close() ?>
            </div>
          </div>
        </div>
      
    </section>