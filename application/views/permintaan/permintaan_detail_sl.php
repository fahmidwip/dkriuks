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
          <h4><strong>Kode Pesanan:</strong> <?= $keranjang[0]->kode_pesanan ?></h4>
          <h4>Tanggal Pesanan: <strong><?= tgl_indo($keranjang[0]->created_at) ?></strong></h4>
          <table class="table table-bordered table-striped" id="example">
            <thead>
              <tr>
                <th>No</th>
                <th>Yang dipesan</th>
                <th>Kuantiti</th>
                
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
                
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                
              </tr>
            </tfoot>
          </table>
          <div>
          <?php if (!empty($keranjang) && is_array($keranjang)): ?>
             
              <h5><strong>Catatan dari Stokis</strong></h5>
              <input type="hidden" name="id_pesan" value="<?= $item->pesan_id ?>">
              <textarea name="catatan_mitra" class="form-control" readonly>
              <?= isset($item->catatan_mitra) ? ($item->catatan_mitra) : '' ?>
            </textarea>
            <?php endif; ?>  
                </div>
                <?php if (!empty($keranjang) && is_array($keranjang)): ?>
            <div class="form-group">
            <label for="catatan_stokis"><b>Catatan Logistik</b></label>
            <textarea name="catatan_stokis" class="form-control" readonly>
            <?= isset($item->catatan_stokis) ? ($item->catatan_stokis) : '' ?>
            </textarea>
            <?php if (!empty($keranjang) && is_array($keranjang)): ?>
            <a href="<?= site_url('pesan/pr/'.$item->pesan_id) ?>" class="btn btn-success">
                <i class="fa fa-print"></i> Print Invoice
              </a>
              <?php endif; ?>
              <?php if (!empty($keranjang) && is_array($keranjang)): ?>
            <a href="<?= site_url('pesan/pr1/'.$item->pesan_id) ?>" class="btn btn-warning">
                <i class="fa fa-print"></i> Print Struk
              </a>
              <?php endif; ?>
            <?php endif; ?>  
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
