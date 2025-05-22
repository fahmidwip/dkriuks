<style>
  @media print {
    @page {
      size: A4 landscape;
      margin: 20mm;
      
    }
    .print-last-page-only {
    display: block;
  }

    body {
      font-family: Arial, sans-serif;
      font-size: 12pt;
    }

    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    
    th, td {
      padding: 8px;
      text-align: left;
    }
  }
</style>
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
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<section class="content">
<body onload="window.print()">
  <?php if (!empty($keranjang) && is_array($keranjang)): ?>
      <div class="box">
        <div class="box-body table-responsive">
        <center><img src="<?=base_url()?>assets/dist/img/ddk.png" alt="User Image" width="140" height="70" class="gambar"></center><br>
          <h6><center>Kode Pesanan: <strong><?= $keranjang[0]->kode_pesanan ?></strong></center></h6>
          <h6><center>Tanggal Pesanan: <strong><?= tgl_indo($keranjang[0]->created_at) ?></strong></center></h6>
          <h6><center>Mitra: <?= $pesan->user ?></center></h6>
  <h6><center>Alamat Mitra: <?= $pesan->alamat ?></center></h6>
  <h6><center>Stokis: <?= $pesan->nama_stokis ?></center></h6>
  <h6><center>Alamat Stokis: <?= $pesan->alamat_stokis ?></center></h6>
          <table class="table table-bordered" id="example">

            <thead>
              <tr>
                <th style="width:5%;">No</th>
                <th>Yang dibeli</th>
                <th style="width:5%;">Kuantiti</th>
                <th>Harga Satuan</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1; 
                $totalSemua = 0; 
                foreach ($keranjang as $item): 
                    $totalSemua += $item->harga_total;
              ?>
              <tr>
              <input type="hidden" name="id_pesan" value="<?= $item->pesan_id ?>">
                <td><center><?= $no++ ?></center></td>

                <td><?= $item->nama_produk ?></td>
                <td><center><?= $item->jumlah ?></center></td>
                <td><?= rupiah($item->harga_mitra) ?></td>
                <td><?= rupiah($item->harga_total) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <!-- Tampilkan hanya di halaman terakhir -->
            <div class="print-last-page-only">
  <table style="margin-left: auto; width: auto;">
    <tr>
      <td colspan="4" style="text-align: right;"><h4><strong>Total Semua</strong></h4></td>
      <td><h4><strong><?= rupiah($totalSemua) ?></strong></h4></td>
    </tr>
  </table>
</div>
          </table>
          
        </div>
      </div>
  <?php else: ?>
    <div class="box">
      <div class="box-body">
        <p>Tidak ada data keranjang.</p>
      </div>
    </div>
  <?php endif; ?>
</body>
</section>
