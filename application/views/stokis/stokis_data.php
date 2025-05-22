<style>
#example {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
}

#example tbody tr:hover {
  background-color: #f5f5f5;
  transition: background-color 0.2s ease;
}

#example th {
  background-color: #3c8dbc;
  color: white;
  text-align: center;
  vertical-align: middle;
}

#example td {
  vertical-align: middle;
}
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
        Daftar 
        <small>Stokis</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Stokis</li>
      </ol>
    </section>
    <!-- Main content -->
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
      <div class = "box">
            <div class = "box-header">
            <h3 class="box-title"> Data Stokis</h3>
            <div class="col card-hader text-right">
                <a href="<?=site_url('stokis/tambah')?>" class="btn btn-primary btn-flat">
                   <i class="fa fa-user-plus"></i>  Buat Stokis
                </a>
        </div><br>
        </div>
        <div class="box-body table-responsive" >
            
            <table class= "table table-bordered table-striped" id="example">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Stokis</th>
                    <th>Alamat</th>
                    <th>provinsi</th>
                    <th>Aksi</th>
</tr>
</thead>
<tbody>
    
    <?php $no = 1; 
    foreach ($row->result() as $key => $data) { ?>
<tr>
        <td style="width:5%;"><?=$no++?></td>
        <td><?=$data->nama_stokis?></td>
        <td><?=$data->alamat?></td>
        <td><?=$data->provinsi_name?></td>
        <td class="text-center" width="160px"> 
        <form action="<?=site_url('stokis/del')?>" method="post">    
        <a href="<?=site_url('stokis/ed/'.$data->id_stokis)?>" class="btn btn-primary btn-xs">
                   <i class="fa fa-pencil"></i>  Edit
            </a>
            
            <input type="hidden" name="id_stokis" value="<?=$data->id_stokis?>">
            <button onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-xs">
                   <i class="fa fa-trash"></i>  Hapus
            </button>
            </form>
        </td>
        
</tr>
<?php
} ?>
</table>
        </div>
    </section>
    