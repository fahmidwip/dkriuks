<style>
@media print {
  @page {
    size: 58mm auto;
    margin: 1mm 0.61in 1mm 1mm;
  }

  body {
    font-family: monospace;
    font-size: 10pt;
    margin: 0;
    padding: 0;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    border-bottom: 1px dashed #000;
    padding: 2px 0;
    text-align: left;
    font-size: 10pt;
  }

  h5, h4 {
    margin: 2px 0;
    text-align: center;
  }

  img {
    display: block;
    margin: 0 auto 4px auto;
    max-width: 100%;
    height: auto;
  }

  .total {
    font-weight: bold;
    font-size: 11pt;
    text-align: right;
    margin-top: 10px;
  }

  small {
    display: block;
    text-align: center;
    margin-top: 5px;
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

    return $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0] . ' ' . $waktu;
}
?>

<body onload="window.print()">
<?php if (!empty($keranjang) && is_array($keranjang)): ?>
  <div style="text-align: center;">
    <img src="<?=base_url()?>assets/dist/img/logo_stokis_dkriuk_2025.png" alt="Logo" style="width: 190px; height: auto;">
  </div>

  <h5>Kode: <?= $keranjang[0]->kode_pesanan ?></h5>
  <h5><?= tgl_indo($keranjang[0]->created_at) ?></h5>
  <h5><center>Mitra: <?= $pesan->user ?></center></h5>
  <h5><center>Alamat Mitra: <?= $pesan->alamat ?></center></h5>
  <h5><center>Stokis: <?= $pesan->nama_stokis ?></center></h5>
  <h5><center>Alamat Stokis: <?= $pesan->alamat_stokis ?></center></h5>
  <hr>
  <table>
    <thead>
      <tr>
        
        <th>Item</th>
        <th>Qty</th>
        <th>Harga</th>
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
        
        <td style="width:5%"><?= $item->nama_produk ?></td>
        <td>|x<?= $item->jumlah ?>|</td>
        <td><?= rupiah($item->harga_mitra) ?>|</td>
        <td><?= rupiah($item->harga_total) ?>|</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p class="total">Pembayaran BCA: <?= rupiah($totalSemua) ?></p>
  <p class="total">Total : <?= rupiah($totalSemua) ?></p>
  
  <center><small>
    Catatan : <br>
    1. Cek Qty dan Profuk sebelum meninggalkan stokis<br>
    2. Produk yang sudah dibeli tidak dapat ditukar atau dikembalikan
  </small></center>
  <center><small>Terima kasih atas pembelian Anda!</small></center>
<?php else: ?>
  <p>Tidak ada data keranjang.</p>
<?php endif; ?>
</body>
