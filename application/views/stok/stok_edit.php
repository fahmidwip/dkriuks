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
    <div class="row">
        <div class="col-md-12 md-offset-4">
            <div class="box">
                <div class="box-header with-border">
                    <h4>Form Edit Data</h4>
                </div>
                <div class="box-body table-responsive" >
                <div class="col-md-12 md-offset-12">
                <!-- Form dimulai di sini -->
                <form action="<?= base_url('stok/editin') ?>" method="post">
                <table class="table table-bordered table-striped">
                        <tr>
                          <input type="hidden" name="id_harga" value="<?= $harga->id_stok ?>">
                            <td style="width:30%;"><strong>Update Stok</strong></td>
                            <td style="width:5%;">:</td>
                            <td>
                                <input type="text" class="form-control" name="update_stok" autocomplete="off">
                            </td>
                        </tr>
                            <td colspan="1">
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
</body>
</html>
