<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <div class="row">
        <div class="col-md-12 md-offset-4">
            <div class="box">
                <div class="box-header with-border">
                    <h4>Form Input Data</h4>
                </div>
                <div class="box-body table-responsive" >
                <div class="col-md-6 md-offset-6">
                <!-- Form dimulai di sini -->
                <form action="<?= base_url('pengajuan/input_ga') ?>" method="post">
                    <table>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td>
                                <input type="text" class="form-control" name="perihal" required autocomplete="off">
                            </td>
                        </tr>

                        <tr>
                            <td>Yang Mengajukan</td>
                            <td>:</td>
                            <input type="hidden" class="form-control" name="pembuat"  
                                       value="<?= ucfirst($this->fungsi->user_login()->user_id) ?>">
                                       <input type="hidden" class="form-control" name="manager"  
                                       value="<?= ucfirst($this->fungsi->user_login()->user_id) ?>">
                            <td>
                                <input type="text" class="form-control" name="pembuat1" disabled  
                                       value="<?= ucfirst($this->fungsi->user_login()->username) ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>Sifat</td>
                            <td>:</td>
                            <td>
                                <select name="sifat" class="form-control" required>
                                    <option value="1" <?= set_value('sifat') == 1 ? "selected" : null ?>>Segera 1-2 hari</option>
                                    <option value="2" <?= set_value('sifat') == 2 ? "selected" : null ?>>Biasa 3-5 hari</option>
                                </select>
                                
                            </td>
                        </tr>

                        <tr>
                            <td>Direktur</td>
                            <td>:</td>
                            <td>
                                <select name="direktur" class="form-control" required>
                                    <option value="11" <?= set_value('direktu') == 11 ? "selected" : null ?>>direktur1</option>
                                    <option value="14" <?= set_value('direktur') == 14 ? "selected" : null ?>>direktur2</option>
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
</body>
</html>
