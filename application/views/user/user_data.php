<style>
    .table-custom thead {
        background-color: #4a90e2; /* Warna header */
        color: white;
    }

    .table-custom tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Warna baris genap */
    }

    .table-custom tbody tr:nth-child(odd) {
        background-color: #ffffff; /* Warna baris ganjil */
    }

    .table-custom td, .table-custom th {
        border: 1px solid #ccc; /* Warna border */
    }
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
        Akun
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Akun</li>
    </ol>
</section>

<section class="content">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('danger')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('danger'); ?></div>
    <?php endif; ?>

    <div class="box">
        <div class="box-header with-border clearfix">
            <h3 class="box-title">Data Pengguna</h3>
            <a href="<?= site_url('user/tambah') ?>" class="btn btn-primary btn-flat pull-right">
                <i class="fa fa-user-plus"></i> Buat Akun
            </a>
        </div>

        <div class="box-body table-responsive">
        <div style="margin-bottom: 10px;">
        <strong>Total Akun: </strong><span class="badge bg-green"><?= $total_user ?></span>
    </div>
            <!-- Form Pencarian -->
            <div style="text-align: right; margin-bottom: 1px;">
    <form method="get" action="<?= site_url('user') ?>" class="form-inline" style="display: inline-block;">
        <div class="form-group">
            <input type="text" name="search" value="<?= $search ?>" class="form-control" placeholder="Pencarian username/nama">
        </div>
        <button type="submit" class="btn btn-default">Cari</button>
        <p style="margin-top: 5px;">Jika ingin melihat semua data kosongkan pencarian dan klik cari</p>
    </form>
</div>


            <!-- Tabel Data -->
            <table class="table table-bordered table-striped table-custom">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Nama Stokis</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($row->num_rows() > 0): ?>
                        <?php $no = (($page - 1) * 20) + 1; foreach ($row->result() as $data): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->username ?></td>
                                <td><?= $data->name ?></td>
                                <td><?= $data->stokis_name ?></td>
                                <td><?= $data->level_nama ?></td>
                                <td class="text-center" width="160px">
                                    <form action="<?= site_url('user/del') ?>" method="post" onsubmit="return confirm('Apakah Anda yakin?')">
                                        <a href="<?= site_url('user/ed/'.$data->user_id) ?>" class="btn btn-primary btn-xs">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <input type="hidden" name="user_id" value="<?= $data->user_id ?>">
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <!-- Tombol First -->
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= site_url('user?search=' . $search . '&page=1') ?>">First</a>
                </li>
            <?php endif; ?>

            <!-- Tombol Previous -->
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= site_url('user?search=' . $search . '&page=' . ($page - 1)) ?>">&laquo;</a>
                </li>
            <?php endif; ?>

            <?php
                $start = max(1, $page - 2);
                $end = min($total_pages, $page + 2);
                for ($i = $start; $i <= $end; $i++):
            ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= site_url('user?search=' . $search . '&page=' . $i) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Tombol Next -->
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= site_url('user?search=' . $search . '&page=' . ($page + 1)) ?>">&raquo;</a>
                </li>
            <?php endif; ?>

            <!-- Tombol Last -->
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= site_url('user?search=' . $search . '&page=' . $total_pages) ?>">Last</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>

        </div>
    </div>
</section>
