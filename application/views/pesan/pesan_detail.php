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
<style>
  .box {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  background-color: #fff;
  padding: 20px;
}
</style>
<section class="content">
  <?php if (!empty($keranjang) && is_array($keranjang)): ?>
    <form action="<?= base_url('pesan/editin') ?>" method="post">
      <div class="box">
        <div class="box-body table-responsive">
          <h4>Kode Pesanan: <strong><?= $keranjang[0]->kode_pesanan ?></strong></h4>
          <h4>Tanggal Pesanan: <strong><?= tgl_indo($keranjang[0]->created_at) ?></strong></h4>
          <h4><strong>Pembayaran Transfer melalui rekening : BCA 8720527333 a/n Raja Rasa Kuliner PT</strong></h4>
          <table class="table table-bordered table-striped" id="example">
            <thead>
              <tr>
                <th>No</th>
                
                <th>Yang dibeli</th>
                <th>Kuantiti</th>
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
                <td><?= $no++ ?></td>
                <td><?= $item->nama_produk ?></td>
                <td><?= $item->jumlah ?></td>
                <td><?= rupiah($item->harga_mitra) ?></td>
                <td><?= rupiah($item->harga_total) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4" style="text-align: right;"><h4><strong>Total Semua</strong></h4></td>
                <td><h4><strong><?= rupiah($totalSemua) ?></strong></h4></td>
              </tr>
            </tfoot>
          </table>

          <div class="form-group">
            <label for="catatan_mitra"><b>Transfer:</b></label>
            <textarea name="catatan_mitra" placeholder="Contoh : BCA a/n fulan no rek 223344112"class="form-control" required></textarea>
          </div>

          <div>
            <button type="submit" class="btn btn-primary"><i class=" fa fa-check"></i>Lanjutkan</button>
          </div>
        </div>
      </div>
    </form>
  <?php else: ?>
    <div class="box">
      <div class="box-body">
        <p>Tidak ada data keranjang.</p>
      </div>
    </div>
  <?php endif; ?>
</section>
