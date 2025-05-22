<section class="content-header">
  <h1>
    List
    <small>Harga</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <form action="<?= base_url('pesan/input') ?>" method="post">
    <div class="box">
      <div class="box-header with-border d-flex justify-content-between align-items-center">
        <h3 class="box-title">Daftar Harga</h3>
      </div>

      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="example">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Item</th>
              <th>Harga Jual Mitra</th>
              <th>Provinsi</th>
              <th>Stok</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($keranjang as $data): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data->nama_item ?></td>
              <td><?= rupiah($data->harga_jual_mitra) ?></td>
              <td><?= $data->provinsi_name ?></td>
              <td><?= $data->stok_barang ?></td>
              <td>
                <input type="hidden" name="id_harga[]" value="<?= $data->id_harga ?>">
                <input type="number" name="pcs[]" value="<?= $data->id_jumlah ?>" class="form-control" min="0">
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </form>
</section>

<!-- Include jQuery & DataTables if needed -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
