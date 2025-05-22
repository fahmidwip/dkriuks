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
                    <div class="col-md-6 md-offset-6">
                        <!-- Form dimulai di sini -->
                        <form action="<?= base_url('harga/input_b') ?>" method="post">
                            <table>
                                <tr>
                                    <td>Nama Item</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control" name="nama_item" required autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" class="form-control" name="harga_jual">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga Mitra</td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" class="form-control" name="harga_jual_mitra">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
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
                                    <td></td>
                                    <td colspan="2">
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
