<?php
function tgl_indo($tanggal) {
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $pecahkan = explode(' ', $tanggal);
    $tgl = explode('-', $pecahkan[0]);
    $waktu = isset($pecahkan[1]) ? $pecahkan[1] : '';

    return $tgl[2] . ' - ' . $bulan[(int)$tgl[1]] . ' - ' . $tgl[0] . ' Jam ' . $waktu;
}
function tgl_indo1($tanggal) {
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $pecahkan = explode(' ', $tanggal);
    $tgl = explode('-', $pecahkan[0]);
    

    return $tgl[2] . ' - ' . $bulan[(int)$tgl[1]] . ' - ' . $tgl[0];
}
?>

<section class="content-header">
    <h1>Data <small>Pengajuan</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengajuan</li>
    </ol>
</section>

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

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Pengajuan</h3>
            <div class="col card-header text-right">
                <a href="<?= site_url('pengajuan/tambah_direktur') ?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-user-plus"></i> Buat Pengajuan
                </a>
            </div><br>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keluhan</th>
                        <th>Yang mengajukan</th>
                        <th>Divisi</th>
                        <th>Sifat</th>
                        <th>Status</th>
                        <th>Pengajuan</th>
                        <th>Update</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($aju_direktur as $data): ?>
                    <tr>
                        <td style="width:5%;"><?= $no++ ?></td>
                        <td><?= $data->perihal ?></td>
                        <td><?= $data->username ?></td>
                        <td><?= $data->divisi ?></td>
                        <td><?= $data->sifat_name ?></td>
                        <td>
                            <?= $data->status_name ?><br>
                            <?php if ($data->status != 1): ?>
                                <?php if ($data->status == 2): ?>
                                    <span class="label label-success pull-left"><small><?= ucfirst($data->spv_username) ?></small></span>
                                <?php elseif ($data->status == 3): ?>
                                    <span class="label label-success pull-left"><small><?= ucfirst($data->manager_username) ?></small></span>
                                <?php elseif ($data->status == 4): ?>
                                    <span class="label label-success pull-left"><small><?= ucfirst($data->direktur_username) ?></small></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td><?= tgl_indo1($data->tgl_buat) ?></td>
                        <td><?= tgl_indo($data->tanggal) ?></td>
                        <td class="text-center" width="160px">
                            <?php if ($data->status == 4): ?>
                                <a href="<?= site_url('pengajuan/kr_direktur/' . $data->id_aju) ?>" class="btn btn-primary btn-xs">
                                    <i class="fa fa-send"></i> Kirim
                                </a>
                                <a href="<?= site_url('pengajuan/del/' . $data->id_aju) ?>" 
                                   class="btn btn-danger btn-xs"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            <?php elseif (in_array($data->status, [2, 3, 4])): ?>
                                <span class="label label-warning">Sudah Dikirim</span>
                            <?php elseif ($data->status == 5): ?>
                                <span class="label label-success">Sudah Selesai</span>
                            <?php elseif ($data->status == 6): ?>
                                <span class="label label-danger">Batal</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
