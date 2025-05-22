<style>
.box {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  background-color: #fff;
  padding: 20px;
}
</style>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <!-- Tambahkan CSS jika diperlukan -->
</head>
<body>
    <div class="row">
        <div class="col-md-12 md-offset-4">
            <div class="box">
                <div class="box-header with-border">
                    <h4>Form Input Harga</h4>
                </div>
                <div class="box-body table-responsive">
                    <div class="col-md-12 md-offset-12">
                        <!-- Form dimulai di sini -->
                        <form action="<?= base_url('harga/input_b') ?>" method="post">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="width:20%;"><strong>Nama Produk</strong></td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control" name="nama_produk" required autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:20%;"><strong>Harga Beli</strong></td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" class="form-control" name="harga_beli">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:20%;"><strong>Harga Stokis</strong></td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" class="form-control" name="harga_stokis">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:20%;"><strong>Harga Mitra</strong></td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" class="form-control" name="harga_mitra">
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Provinsi</strong></td>
                                    <td>:</td>
                                    <td>
                                        <select name="provinsi" class="form-control">
                                            <option value="">== Pilih ==</option>
                                            <?php foreach ($provinsi as $p): ?>
                                                <option value="<?= $p->id_prov ?>" <?= set_value('provinsi_form') == $p->id_prov ? 'selected' : '' ?>>
                                                    <?= $p->provinsi ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td colspan="1">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <!-- Form berakhir di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
