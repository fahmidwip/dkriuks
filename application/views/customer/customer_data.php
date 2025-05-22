<section class="content-header">
      <h1>
        Akun 
        <small>Pelanggan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Akun</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class = "box">
            <div class = "box-header">
            <h3 class="box-title"> Data Pelanggan</h3>
            <div class="col card-hader text-right">
                <a href="<?=site_url('cust/tambah')?>" class="btn btn-primary btn-flat">
                   <i class="fa fa-user-plus"></i>  Buat Akun
                </a>
        </div><br>
        </div>
        <div class="box-body table-responsive" >
            
            <table class= "table table-bordered table-striped" id="example">
                <thead>
                <tr>
                    <th>No</th>
                    <th>name</th>
                    <th>No. Telpon</th>
                    <th>Alamat</th>
                    <th>Gender</th>
                    <th>Aksi</th>
</tr>
</thead>
<tbody>
    
    <?php $no = 1; 
    foreach ($row->result() as $key => $data) { ?>
<tr>
        <td style="width:5%;"><?=$no++?></td>
        <td><?=$data->name?></td>
        <td><?=$data->phone?></td>
        <td><?=$data->alamat?></td>
        <td><?=$data->gender?></td>
        <td class="text-center" width="160px"> 
        <a href="<?=site_url('cust/edit/'.$data->cust_id)?>" class="btn btn-primary btn-xs bg-blue">
                   <i class="fa fa-pencil"></i>  Edit
            </a>
        <a href="<?=site_url('cust/del/'.$data->cust_id)?>" onclick="return confirm('Yakin menghapus data?')" class="btn btn-primary btn-xs bg-red">
                   <i class="fa fa-trash"></i>  Hapus
            </a>
            
        </td>
        
</tr>
<?php
} ?>
</table>
        </div>
    </section>