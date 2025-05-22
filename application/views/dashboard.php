<style>
.small-box {
    position: relative;
    overflow: hidden;
    box-shadow: 0 6px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border-radius: 10px;
}

.small-box:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 12px rgba(0,0,0,0.2);
}

.small-box .icon {
    font-size: 69px;
    opacity: 0.3;
    transition: opacity 0.3s ease;
}

.small-box:hover .icon {
    opacity: 0.6;
}

.box {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  background-color: #fff;
  padding: 20px;
}

</style>


<?php
function tgl_indo($tanggal) {
  // Cek jika kosong atau bukan string
  if (empty($tanggal) || !is_string($tanggal)) {
      return '-';
  }

  $bulan = array(
      1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  );

  // Pecah antara tanggal dan waktu (jika ada)
  $pecahkan = explode(' ', trim($tanggal));

  if (!isset($pecahkan[0]) || empty($pecahkan[0])) {
      return '-';
  }

  $tgl = explode('-', $pecahkan[0]);

  // Pastikan format tanggal terdiri dari 3 bagian: YYYY-MM-DD
  if (count($tgl) !== 3 || !ctype_digit($tgl[0]) || !ctype_digit($tgl[1]) || !ctype_digit($tgl[2])) {
      return '-';
  }

  $tahun = (int)$tgl[0];
  $bulanIndex = (int)$tgl[1];
  $hari = (int)$tgl[2];

  // Validasi tanggal menggunakan checkdate()
  if (!checkdate($bulanIndex, $hari, $tahun)) {
      return '<strong>Ini Login Pertama Anda</strong>';
  }

  // Ambil waktu jika ada
  $waktu = isset($pecahkan[1]) ? trim($pecahkan[1]) : '';

  // Susun format akhir
  return $hari . ' ' . $bulan[$bulanIndex] . ' ' . $tahun . ($waktu ? ' Jam ' . $waktu : '');
}



$buat = $this->fungsi->user_login()->buat;
if ($buat) {
    echo "<div class='alert alert-info'>Login terakhir Anda:  " . (tgl_indo($buat)) . "</div>";
} else {
    echo "<div class='alert alert-warning'>Ini adalah login pertama Anda.</div>";
}
?>
<?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('danger')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('danger'); ?></div>
    <?php endif; ?>
<section class="content">
<?php if($this->fungsi->user_login()->level == 2) { ?>
  <div class="box box-primary" style="margin-top: 20px;">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard</h3>
    </div>

    <div class="box-body">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
              
              <p>Pesanan Baru</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <h3>&nbsp<?= $count_new_pesan_mit?></h3>
            <a href="<?=site_url('pesan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $count_new_pesan_tl_mit?></h3>
              <p>Proses</p>
            </div>
            <div class="icon">
            <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?=site_url('pesan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
              
              <p>Pesanan Selesai</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <h3>&nbsp<?= $count_new_pesan_s_mit?></h3>
            <a href="<?=site_url('pesan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
              
              <p>Pesanan Batal</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <h3>&nbsp<?= $count_new_pesan_b_mit?></h3>
            <a href="<?=site_url('pesan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>

        </div>
      </div>
    </div>
  </div>
  
<?php } ?>
      <?php if($this->fungsi->user_login()->level == 1) { ?>
<!-- Small boxes (Stat box) -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Dashboard</h3>
  </div>
  <div class="box-body">
      <div class="card-body">
      <div class="row">
      <div class="col-md-16">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
              
              <p>Pesanan Baru</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <h3>&nbsp<?= $count_new_pesan_tl?></h3>
            <a href="<?=site_url('pesan/pesanan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
              
              <p>Pesanan Selesai</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <h3>&nbsp<?= $count_new_pesan_s?></h3>
            <a href="<?=site_url('pesan/pesanan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
              
              <p>Pesanan Batal</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <h3>&nbsp<?= $count_new_pesan_b?></h3>
            <a href="<?=site_url('pesan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
        </div>
        <!-- ./col -->
      </div>
      </div>
      <?php } ?> 

      
      
      <?php if($this->fungsi->user_login()->level == 4) { ?>
  <div class="box box-primary" style="margin-top: 20px;">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard</h3>
    </div>

    <div class="box-body">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <p>Total Semua Harga</p>
              <h3><?= $count_harga ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="<?= site_url('harga/index_b') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <p>Harga Jawa</p>
              <h3><?= $count_harga_jawa ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="<?= site_url('harga/jawa') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <p>Harga sumatera</p>
              <h3><?= $count_harga_sumatra ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="<?= site_url('harga/sumatera') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <p>Harga WITA</p>
              <h3><?= $count_harga_wita ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="<?= site_url('harga/wita') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php } ?>


<?php if($this->fungsi->user_login()->level == 7) { ?>
  <div class="box box-primary" style="margin-top: 20px;">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard</h3>
    </div>

    <div class="box-body">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <p>Total Semua Mitra</p>
              <h3><?= $count_user_mitra_all ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?= site_url('kemitraan') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
            <p>Total Mitra Jawa</p>
              <h3><?= $count_user_mitra_jawa ?></h3>
            </div>
            <div class="icon">  
              <i class="fa fa-user"></i>
            </div>
            <a href="<?= site_url('kemitraan/jawa') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
            <p>Total Mitra Sumatera</p>
              <h3><?= $count_user_mitra_sumatera ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="<?= site_url('kemitraan/sumatera') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
            <p>Total Mitra WITA</p>
              <h3><?= $count_user_mitra_wita ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="<?= site_url('kemitraan/wita') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php } ?>

      <style>

.small-box .icon {
    top: 5px;
    right: 10px;
    height: auto;
    width: auto;
}
</style>
<?php if($this->fungsi->user_login()->level == 5) { ?>
  <div class="box box-primary" style="margin-top: 20px;">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard</h3>
    </div>

    <div class="box-body">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>            
              <h5>Pengguna</h5>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <h3>&nbsp<strong><?= $count_user?></strong></h3>
            <a href="<?=site_url('user')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
            <strong><h5>Jawa</h5></strong>
              <h5>Stokis : <strong><?= $count_user_stokis_jawa?></strong></h5>
              <h5>Mitra : <strong><?= $count_user_mitra_jawa?></strong></h5>
            </div>
            <div class="icon">
            <i class="fa fa-user"></i>
            </div>
            <a href="<?=site_url('user')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <strong><h5>Sumatera</h5></strong>
              <h5>Stokis : <strong><?= $count_user_stokis_sumatera?></strong></strong></h5>
              <h5>Mitra : <strong><?= $count_user_mitra_sumatera?></strong></h5>
            </div>
            <div class="icon">
            <i class="fa fa-user"></i>
            </div>
            <a href="<?=site_url('user')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
            <strong><h5>WITA</h5></strong>
              <h5>Stokis : <strong><?= $count_user_stokis_wita?></strong></h5>
              <h5>Mitra : <strong><?= $count_user_mitra_wita?></strong></h5>
            </div>
            <div class="icon">
            <i class="fa fa-user"></i>
            </div>
            <a href="<?=site_url('user')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>
    </div>
  </div>
  
<?php } ?>



<?php if($this->fungsi->user_login()->level == 8) { ?>
  <div class="box box-primary" style="margin-top: 20px;">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard</h3>
    </div>

    <div class="box-body">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <p>Total Transaksi Penjualan</p>
              <h3><?= $count_penjualan ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="<?= site_url('penjualan/index1') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <p>Transaksi Bahan Baku</p>
              <h3><?= $count_permintaan_stok ?></h3>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="<?= site_url('permintaan/pesanan_lap_po_direk') ?>" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          
        </div>
      </div>
    </div>
  </div>
  
<?php } ?>

      <?php if($this->fungsi->user_login()->level == 6) { ?>
<!-- Small boxes (Stat box) -->
<div class="box box-primary" style="margin-top: 20px;">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard</h3>
    </div>

    <div class="box-body">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>            
              <p>Produk</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <h3>&nbsp<strong><?= $count_item_jawa?></strong></h3>
            <a href="<?=site_url('stok')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>            
              <p>Permintaan Baru</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck"></i>
            </div>
            <h3>&nbsp<strong><?= $count_total_stokis?></strong></h3>
            <a href="<?=site_url('permintaan/pesanan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>            
              <p>Permintaan Selesai</p>
            </div>
            <div class="icon">
              <i class="fa  fa-check-square"></i>
            </div>
            <h3>&nbsp<strong><?= $count_total_stokis_tl?></strong></h3>
            <a href="<?=site_url('permintaan/pesanan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>            
              <p>Permintaan Batal</p>
            </div>
            <div class="icon">
              <i class="fa  fa-exclamation-circle"></i>
            </div>
            <h3>&nbsp<strong><?= $count_total_stokis_tl_b?></strong></h3>
            <a href="<?=site_url('permintaan/pesanan')?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
        <?php } ?> 




      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
var newOrders = <?= $count_new_ayam ?>;
var processOrders = <?= $count_new_kentang ?>;
var completedOrders = <?= $count_new_usus ?>;
var kulitOrders = <?= $count_new_kulit ?>;

var ctx = document.getElementById('pesananChart').getContext('2d');
var pesananChart = new Chart(ctx, {
    type: 'bar', // Gunakan tipe 'line' untuk area chart
    data: {
        labels: ['Order Ayam', 'Order Kentang', 'Order Usus', 'Order Kulit'],
        datasets: [{
            label: 'Jumlah Pesanan',
            data: [newOrders, processOrders, completedOrders, kulitOrders],
            backgroundColor: 'rgba(0, 192, 239, 0.4)', // Area fill
            borderColor: '#00c0ef',
            fill: true, // Aktifkan area fill
            tension: 0.4, // Membuat garis agak melengkung, opsional
            pointBackgroundColor: '#00c0ef',
            pointBorderColor: '#fff',
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
