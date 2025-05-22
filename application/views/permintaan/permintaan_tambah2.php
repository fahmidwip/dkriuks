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
    List
    <small>Harga</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="<?= base_url('permintaan') ?>"><i class="fa fa-cart-plus"></i> Permintaan Stok</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<form action="<?= base_url('permintaan/input') ?>" method="post">
  <div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
      <h3 class="box-title">Daftar Harga</h3>
      
    </div>
<div class="form-group" style="max-width: 300px;">
  <strong><h4 style="margin-bottom: 5px;">Pencarian</h4></strong>
  <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Item atau Provinsi...">
</div>

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="exampless">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            
            <th>Provinsi</th>
            <th>Stok Logistik</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($row as $data): ?>
          <tr>
            <td style="width:5%;"><?= $no++ ?></td>
            <td ><?= $data->nama_produk ?></td>
            <td style="width:25%;"><?= $data->provinsi_name ?></td>
            <td style="width:15%;"> <?= $data->stok ?> Pcs</td>
            <td style="width:10%;">
              <input type="hidden" name="id_harga[]" value="<?= $data->barang_id ?>">
              <input type="hidden" name="id_stok[]" value="<?= $data->id_stok ?>">
              <input type="number" name="pcs[]" class="form-control" min="0">
            </td>
          </tr>
          
          <?php endforeach; ?>
          
        </tbody>
      </table>
      
      
                            
      <div>
        <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
    </div>
    </form>
  </div>

</section>
<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll("table tbody tr");

  rows.forEach(row => {
    const namaItem = row.cells[1].textContent.toLowerCase();
    const provinsi = row.cells[3].textContent.toLowerCase();

    if (namaItem.includes(filter) || provinsi.includes(filter)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
});
</script>