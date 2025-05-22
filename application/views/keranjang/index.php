<section class="content-header">
  <h1>
    Akun
    <small>Pengguna</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Akun</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

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
          <?php 
          $no = 1;
          $total_harga = 0; // Variabel untuk total harga
          foreach ($keranjang as $data): 
            $total_harga += $data->harga_jual_mitra; // Tambahkan harga jual mitra ke total
          ?>
          <tr>
            <td style="width:5%;"><?= $no++ ?></td>
            <td><?php if (isset($keranjang) && is_object($keranjang)): ?>
    <p><?= $keranjang->name_item; ?></p>
<?php else: ?>
    <p>Barang tidak ditemukan</p>
<?php endif; ?></td>
            <td><?= number_format($data->harga_jual_mitra, 0, ',', '.') ?></td> <!-- Format angka -->
            <td><?= $data->provinsi_name ?></td>
            <td class="text-center" width="250px">
              <a href="<?= site_url('supplier/edit/'.$data->id_harga) ?>" class="btn btn-warning btn-xs">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <a href="<?= site_url('supplier/del/'.$data->id_harga) ?>" onclick="return confirm('Yakin menghapus data?')" class="btn btn-danger btn-xs">
                <i class="fa fa-trash"></i> Hapus
              </a>
              <a href="<?= site_url('keranjang/tambah/'.$data->id_harga) ?>" class="btn btn-success btn-xs">
                <i class="fa fa-cart-plus"></i> Tambah ke Keranjang
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Menampilkan Total Harga -->
      <div class="row">
        <div class="col-md-12 text-right">
          <h4>Total Harga: Rp. <?= number_format($total_harga, 0, ',', '.') ?></h4>
        </div>
      </div>
    </div>
  </div>

</section>
