<section class="content-header">
      <h1>
        Item
        <small>Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Item</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class = "box">
            <div class = "box-header">
            <h3 class="box-title"> Macam macam Item</h3>
            <div class="col card-hader text-right">
                <a href="<?=site_url('item/tambah')?>" class="btn btn-primary btn-flat">
                   <i class="fa fa-user-plus"></i>  Tambah
                </a>
        </div><br>
        </div>
        <div class="box-body table-responsive" >
            
            <table class= "table table-bordered table-striped" id="example">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Barcode</th>
                    <th>Name</th>
                    <th>Kategori</th>
                    <th>Unit</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Lampiran</th>
                    <th>Aksi</th>
</tr>
</thead>
<tbody>
    
    <?php $no = 1; 
    foreach ($row->result() as $key => $data) { ?>
<tr>
        <td style="width:5%;"><?=$no++?></td>
        <td><?=$data->barcode?></br>
        <a href="<?=site_url('item/barcode_qr/'.$data->item_id)?>" class="btn btn-primary btn-xs">
        Generate <i class="fa fa-barcode"></i>  
            </a>
      </td>
        <td><?=$data->name?></td>
        <td><?=$data->category_name?></td>
        <td><?=$data->unit_name?></td>
        <td><?=$data->price?></td>
        <td><?=$data->stock?></td>
        <td>
          <?php if($data->files != null) { ?>
            <img src="<?=base_url('file/'.$data->files)?>" style="width:100px">
            <?php } ?>
               
        </td>
        <td class="text-center" width="160px"> 
        <a href="<?=site_url('item/edit/'.$data->item_id)?>" class="btn btn-primary btn-xs bg-blue">
                   <i class="fa fa-pencil"></i>  Edit
            </a>
        <a href="<?=site_url('item/del/'.$data->item_id)?>" onclick="return confirm('Yakin menghapus data?')" class="btn btn-primary btn-xs bg-red">
                   <i class="fa fa-trash"></i>  Hapus
            </a>
            
        </td>
        
</tr>
<?php
} ?>
</table>
        </div>
    </section>