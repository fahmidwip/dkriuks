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
    <title>Edit Data</title>
</head>
<body>
<div class="card-body">
    <div class="row">
        <div class="col-md-12 md-offset-4">
            <div class="box">
                <div class="box-header with-border">
                    <h4>Form Edit Data</h4>
                </div>
                <div class="box-body table-responsive" >
                <div class="col-md-12 md-offset-12">
                <!-- Form dimulai di sini -->
                <form action="<?= base_url('harga/editin') ?>" method="post">
                <table class="table table-bordered table-striped">
                        <tr>
                          <input type="hidden" name="id_harga" value="<?= $harga->id_harga ?>">
                            <td style="width:30%;"><strong>Nama Barang</strong></td>
                            <td style="width:5%;">:</td>
                            <td>
                                <input type="text" value="<?= $harga->nama_produk ?>" class="form-control" name="nama_produk" required autocomplete="off" disabled>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:20%;"><strong>Harga beli</strong></td>
                            <td>:</td>
                            <input type="hidden" name="id_aju" value="<?= $harga->id_harga ?>">
                            <td>
                                <input type="text" class="form-control" name="harga_beli"  
                                       value="<?= $harga->harga_beli ?>">
                            </td>
                        </tr>

                        <tr>
                            <td style="width:20%;"><strong>Harga stokis</strong></td>
                            <td>:</td>
                            <input type="hidden" name="id_aju" value="<?= $harga->id_harga ?>">
                            <td>
                                <input type="text" class="form-control" name="harga_stokis"  
                                       value="<?= $harga->harga_stokis ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;"><strong>Harga mitra</strong></td>
                            <td>:</td>
                            <input type="hidden" name="id_aju" value="<?= $harga->id_harga ?>">
                            <td>
                                <input type="text" class="form-control" name="harga_mitra"  
                                       value="<?= $harga->harga_mitra ?>">
                            </td>
                        </tr>

                        <tr>
                            <td style="width:20%;"><strong>Provinsi</strong></td>
                            <td>:</td>
                            <input type="hidden" name="id_aju" value="<?= $harga->id_harga ?>">
                            <td>
                            <select name="provinsi_form" class="form-control">
                            <option value="1" <?= ($this->input->post('provinsi_form') ?? $harga->provinsi) == 1 ? 'selected' : '' ?>>Jawa</option>
                            <option value="3" <?= ($this->input->post('provinsi_form') ?? $harga->provinsi) == 3 ? 'selected' : '' ?>>Sumatera</option>
                            <option value="7" <?= ($this->input->post('provinsi_form') ?? $harga->provinsi) == 7 ? 'selected' : '' ?>>WITA</option>
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
                </div>
                </div>
                <!-- Form berakhir di sini -->

            </div>
        </div>
    </div>
    </div>
</body>
</html>
