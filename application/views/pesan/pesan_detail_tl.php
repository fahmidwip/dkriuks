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
    <form action="<?= base_url('pesan/editin_tl') ?>" method="post">
      <div class="box">
        <div class="box-body table-responsive">
          <h4><strong>Kode Pesanan:</strong> <?= $keranjang[0]->kode_pesanan ?></h4>
          <h4>Tanggal Pesanan: <strong><?= tgl_indo($keranjang[0]->created_at) ?></strong></h4>
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
                <!-- Menyimpan id_pesan sekali di form utama -->
                <input type="hidden" name="id_pesan" value="<?= $item->pesan_id ?>">
                <input type="hidden" name="id_harga[]" value="<?= $item->barang_id ?>">
                <input type="hidden" name="id_stok[]" value="<?= $item->jenis_id ?>">
                <input type="hidden" name="jumlah[]" value="<?= $item->jumlah ?>">
                
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
          
          <!-- Catatan dari Mitra -->
          <div>
            <h5><strong>Transfer Mitra</strong></h5>
            <textarea name="catatan_mitra" class="form-control" readonly>
              <?= isset($keranjang[0]->catatan_mitra) ? $keranjang[0]->catatan_mitra : '' ?>
            </textarea>
          </div>

          <!-- Catatan Stokis -->
          <div class="form-group">
            <label for="catatan_stokis"><b>Konfirmasi</b></label>
            <textarea name="catatan_stokis" placeholder="Contoh : Pesanan Sudah di Ambil" class="form-control" required></textarea>
          </div>  

          <div>
            <button type="submit" class="btn btn-success"><i class=" fa fa-check"></i> Selesai</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
                Pesanan diBatalkan
            </button>
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

  <!-- Modal Batal -->
  <div class="modal fade" id="modal-default">
    <form action="<?= base_url('pesan/editin_tl_batal') ?>" method="post">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Alasan Batal</h4>
          </div>

          <div class="modal-body">
            <!-- Menyimpan id_pesan sekali di form batal -->
            <input type="hidden" name="id_pesan" value="<?= $keranjang[0]->pesan_id ?>">
            <div class="form-group">
              <label for="catatan_batal"><b>Catatan</b></label>
              <textarea name="catatan_batal" class="form-control" required></textarea>
            </div>  
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
