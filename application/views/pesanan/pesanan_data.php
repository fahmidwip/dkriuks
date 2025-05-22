<section class="content-header">
  <h1>
    Akun
    <small>Pengguna</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Akun</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
      <h3 class="box-title">Daftar Harga</h3>
      <a href="<?= site_url('supplier/tambah') ?>" class="btn btn-primary btn-flat">
        <i class="fa fa-user-plus"></i> Buat Akun
      </a>
    </div>

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="example">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Harga Jual Mitra</th>
            <th>Provinsi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($row as $data): ?>
          <tr>
            <td style="width:5%;"><?= $no++ ?></td>
            <td><?= $data->name_barang ?></td>
            <td><?= $data->harga_jual_mitra ?></td>
            <td><?= $data->provinsi_name ?></td>
            <td class="text-center" width="250px">
  <a href="<?= site_url('keranjang/tambah/'.$data->id_harga) ?>" class="btn btn-success btn-xs">
    <i class="fa fa-cart-plus"></i> Tambah ke Keranjang
  </a>
</td>

          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</section>
