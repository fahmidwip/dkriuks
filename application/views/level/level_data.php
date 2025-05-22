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
        Daftar
        <small>Level</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Level</li>
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
            <h3 class="box-title"> Data Level</h3>
            <div class="col card-hader text-right">
                <a href="<?=site_url('level/tambah')?>" class="btn btn-primary btn-flat">
                   <i class="fa fa-plus"></i>  Tambah Level
                </a>
        </div><br>
        </div>
        <div class="box-body table-responsive" >
            
            <table class= "table table-bordered table-striped" id="example">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Level</th>
                    <th>Aksi</th>
</tr>
</thead>
<tbody>
    
    <?php $no = 1; 
    foreach ($row->result() as $key => $data) { ?>
<tr>
        <td style="width:5%;"><?=$no++?></td>
        <td><?=$data->level?></td>

        <td class="text-center" width="160px"> 
        <form action="<?=site_url('level/del')?>" method="post">    
        <a href="<?=site_url('level/ed/'.$data->id_level)?>" class="btn btn-primary btn-xs">
                   <i class="fa fa-pencil"></i>  Edit
            </a>
            
            <input type="hidden" name="id_level" value="<?=$data->id_level?>">
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