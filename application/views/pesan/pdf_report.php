<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pesan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h3>Laporan Pesan</h3>
    <p>Periode: <?= tgl_indo1($start_date) ?> s/d <?= tgl_indo1($end_date) ?></p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pesanan</th>
                <th>Pemesan</th>
                <th>Stokis</th>
                <th>Status</th>
                <th>Tanggal Pesan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($rows_tl_sum as $data): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data->kode_pesanan ?></td>
                <td><?= $data->user ?></td>
                <td><?= $data->stokis_nama ?></td>
                <td><?= ucfirst($data->statusnya) ?></td>
                <td><?= tgl_indo1($data->tanggal) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
