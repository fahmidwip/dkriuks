<style>
.sidebar-menu > li > a {
    font-size: 15px;
    padding: 12px 20px;
    color: #fff;
    transition: background 0.8s ease;
}

.sidebar-menu > li.active > a,
.sidebar-menu > li > a:hover {
    background-color: #c9302c;
    color: #fff;
    font-weight: 600;
}

.user-panel img {
    border: 2px solid #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

.logo-lg b {
    color: #ffffff;
    font-weight: bold;
    letter-spacing: 1px;
}

.navbar {
    background-color: #dd4b39;
    border-bottom: 2px solid #c23321;
}

.skin-red .main-header .logo {
    background-color: #c9302c;
    color: #fff;
}

.skin-red .main-header .logo:hover {
    background-color: #b52b25;
}

.sidebar-menu .header {
    font-size: 13px;
    color: #ddd;
    text-transform: uppercase;
    margin-top: 10px;
}

.user-footer .btn {
    width: 100%;
    font-weight: bold;
}

.content-wrapper {
    background: #f5f5f5;
    padding: 3px;
    
}

.sidebar {
  transition: all 0.3s ease-in-out;
  
}
.btn, .sidebar-menu li a {
  transition: all 0.2s ease-in-out;
}

.sidebar-menu li a:hover {
  transform: translateX(1px);
}

.sidebar-menu li a:hover::before {
    transform: translateX(0);
}

.sidebar-menu li a i {
    transition: transform 0.3s ease;
}

.sidebar-menu li a:hover i {
    transform: scale(1.4) rotate(10deg);
}
.sidebar-menu li a:hover {
    background: linear-gradient(45deg, #c9302c, #a30000);
    color: #fff;
}
.jam-digital {
  position: fixed;
  top: 5px;
  right: 5px;
  color: white;
  font-size: 18px;
  font-weight: bold;
  font-family: 'Poppins', sans-serif;
  background-color: transparent;
  padding: 8px 12px;
  border-radius: 8px;
  z-index: 9999;
  

}

#example {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
}


#example tbody tr:hover {
  background-color: #f5f5f5;
  transition: background-color 0.2s ease;
}

#example th {
  background-color: #3c8dbc;
  color: white;
  text-align: center;
  vertical-align: middle;
}

#example td {
  vertical-align: middle;
}

#example1 {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
}


#example1 tbody tr:hover {
  background-color: #f5f5f5;
  transition: background-color 0.2s ease;
}

#example1 th {
  background-color: #3c8dbc;
  color: white;
  text-align: center;
  vertical-align: middle;
}

#example1 td {
  vertical-align: middle;
}
.sidebar-menu li.active > a {
   
    color: #fff !important;
    font-weight: bold;
    border-left: 4px solid #fff; /* Tanda strip putih di kiri */
    
  animation: slideIn 0.3s ease forwards;
}

.sidebar-menu li.sub-active > a {
   
    color: #fff !important;
    font-weight: bold;
    border-left: 4px solid #ffd700; /* warna emas sebagai penanda */
}

@keyframes slideIn {
  from {
    transform: translateX(-10px);
    opacity: 0.5;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}



</style>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pemesanan Stokis </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/skins/_all-skins.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url()?>dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>K</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Dkriuk</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="jam-digital" id="jam"></div>
      <div class="navbar-custom-menu">
      
      <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
           
          <li class="dropdown user user-menu">
            
            <ul class="dropdown-menu">
              <!-- User image -->
              
              <li class="user-footer">
                
                <div class="pull-right">
                  <a href="<?=site_url('auth/logout')?>" class="btn btn-default bg-red">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>assets/dist/img/bulatdkriuklogobaru2025_PNG.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=ucfirst($this->fungsi->user_login()->username)?></p>
          <p>Harga :<?=ucfirst($this->fungsi->user_login()->provinsi_name)?></p>
          
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      <li <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
          <a href="<?=site_url('dashboard')?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        
      
      <?php if($this->fungsi->user_login()->level == 2) { ?>
        <li class="header">MENU</li>
        <li <?=$this->uri->segment(1) == 'pesan' ? 'class="active"' : '' ?>>
          <a href="<?=site_url('pesan')?>"><i class=" fa fa-shopping-cart"></i> <span>Pesan</span></a></li>
        
</li>

          <?php } ?> 
          <?php if($this->fungsi->user_login()->level == 4) { ?>
    <li class="header">MENU</li>

    <!-- Menu Harga dengan Submenu -->
    <li class="treeview <?= $this->uri->segment(1) == 'harga' ? 'active' : '' ?>">
        <a href="#">
            <i class="fa fa-tags"></i> <span>Harga</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?= $this->uri->segment(2) == 'index_b' ? 'active' : '' ?>">
                <a href="<?= site_url('harga/index_b') ?>"><i class="fa fa-circle-o"></i> Semua Harga</a>
            </li>
            <li class="<?= $this->uri->segment(2) == 'jawa' ? 'active' : '' ?>">
                <a href="<?= site_url('harga/jawa') ?>"><i class="fa fa-circle-o"></i> Harga Jawa</a>
            </li>
            <li class="<?= $this->uri->segment(2) == 'sumatera' ? 'active' : '' ?>">
                <a href="<?= site_url('harga/sumatera') ?>"><i class="fa fa-circle-o"></i> Harga Sumatera</a>
            </li>
            <li class="<?= $this->uri->segment(2) == 'wita' ? 'active' : '' ?>">
                <a href="<?= site_url('harga/wita') ?>"><i class="fa fa-circle-o"></i> Harga WITA</a>
            </li>
        </ul>
    </li>
<?php } ?>

          <?php if($this->fungsi->user_login()->level == 1) { ?>
            <li class="header">MENU</li>
          <li <?=$this->uri->segment(1) == 'pesan' ? 'class="active"' : '' ?>>
          <a href="<?=site_url('pesan/pesanan')?>"><i class=" fa fa-shopping-cart"></i> <span>Pesanan</span></a></li>
<li class="treeview <?=$this->uri->segment(1) == 'penjualan' ? 'active menu-open' : '' ?>">
  <a href="#"><i class="fa fa-cart-arrow-down"></i> Penjualan
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" style="<?=$this->uri->segment(1) == 'penjualan' ? 'display: block;' : '' ?>">
    <li class="<?=$this->uri->segment(2) == '' ? 'active' : '' ?>">
      <a href="<?=site_url('penjualan')?>"><i class="fa fa-book"></i> Berdasarkan PO</a>
    </li>
    <li class="<?=$this->uri->segment(2) == 'index2' ? 'active' : '' ?>">
      <a href="<?=site_url('penjualan/index2')?>"><i class="fa fa-book"></i> Berdasarkan Item</a>
    </li>
  </ul>
</li>

          <li <?= $this->uri->segment(1) == 'permintaan' && $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
    <a href="<?= site_url('permintaan') ?>"><i class="fa fa-cart-plus"></i> <span>Permintaan Stok</span></a>
</li>
<li <?= $this->uri->segment(1) == 'permintaan' && $this->uri->segment(2) == 'pesanan_lap_stokis' ? 'class="active"' : '' ?>>
    <a href="<?= site_url('permintaan/pesanan_lap_stokis') ?>"><i class="fa  fa-check"></i> <span>Permintaan Stok Selesai</span></a>
</li>

          <li <?=$this->uri->segment(1) == 'stok' ? 'class="active"' : '' ?>>
          <a href="<?=site_url('stok/stokis')?>"><i class="fa fa-pencil-square-o"></i> <span>Adjustment Stok</span></a></li>
          <?php } ?> 
<?php if ($this->fungsi->user_login()->level == 6) { ?>
    <li class="header">MENU</li>

    <!-- Menu Adjustment Stok -->
    <li class="<?= ($this->uri->segment(1) == 'stok' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
    <a href="<?= site_url('stok') ?>">
        <i class="fa fa-cubes"></i> <span>Adjustment Stok</span>
    </a>
</li>

<?php if ($this->fungsi->user_login()->user_id == 6585): ?>
    <li class="<?= ($this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'wita') ? 'active' : '' ?>">
        <a href="<?= site_url('stok/wita') ?>">
            <i class="fa fa-cubes"></i> <span>Adjustment Stok Wita</span>
        </a>
    </li>
<?php endif; ?>

    <!-- Menu Permintaan -->
    <?php
    $isPermintaan = $this->uri->segment(1) == 'permintaan';
    $isPesanan = $this->uri->segment(2) == 'pesanan';
    $isPesananLap = $this->uri->segment(2) == 'pesanan_lap';
    $isPesananLap2 = $this->uri->segment(2) == 'pesanan_lap2';
    $isSubActive = $isPesananLap || $isPesananLap2;
    ?>

    <li class="treeview <?= ($isPermintaan && ($isPesanan || $isSubActive)) ? 'active' : '' ?>">
        <a href="#">
            <i class="fa fa-book"></i> <span>Permintaan Stokis</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu" style="<?= $isPermintaan ? 'display: block;' : '' ?>">
            <li <?= $isPesanan ? 'class="active"' : '' ?>>
                <a href="<?= site_url('permintaan/pesanan') ?>"><i class="fa fa-circle-o"></i> Permintaan Baru</a>
            </li>
            <li <?= $isPesananLap ? 'class="active"' : '' ?>>
                <a href="<?= site_url('permintaan/pesanan_lap') ?>"><i class="fa fa-circle-o"></i>Laporan Berdasarkan PO</a>
            </li>
            <li <?= $isPesananLap2 ? 'class="active"' : '' ?>>
                <a href="<?= site_url('permintaan/pesanan_lap2') ?>"><i class="fa fa-circle-o"></i>Laporan Berdasarkan Item</a>
            </li>
        </ul>
    </li>
<?php } ?>





          <?php if($this->fungsi->user_login()->level == 7) { ?>
            <li class="header">MENU</li>
          <li class="treeview <?= $this->uri->segment(1) == 'kemitraan' ? 'active' : '' ?>">
        <a href="#">
            <i class="fa fa-users"></i> <span>Kemitraan</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?= $this->uri->segment(2) == 'index1' ? 'active' : '' ?>">
                <a href="<?= site_url('kemitraan/index1') ?>"><i class="fa fa-user"></i> Semua Mitra</a>
            </li>
            <li class="<?= $this->uri->segment(2) == 'jawa' ? 'active' : '' ?>">
                <a href="<?= site_url('kemitraan/jawa') ?>"><i class="fa fa-user"></i> Mitra Jawa</a>
            </li>
            <li class="<?= $this->uri->segment(2) == 'sumatera' ? 'active' : '' ?>">
                <a href="<?= site_url('kemitraan/sumatera') ?>"><i class="fa fa-user"></i> Mitra Sumatera</a>
            </li>
            <li class="<?= $this->uri->segment(2) == 'wita' ? 'active' : '' ?>">
                <a href="<?= site_url('kemitraan/wita') ?>"><i class="fa fa-user"></i> Mitra WITA</a>
            </li>
        </ul>
    </li>
          
          <?php } ?> 
          <?php if($this->fungsi->user_login()->level == 8) { ?>
            <li class="header">MENU</li>
            <li class="treeview <?=$this->uri->segment(1) == 'penjualan' ? 'active menu-open' : '' ?>">
  <a href="#"><i class="fa fa-book"></i> Penjualan
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" style="<?=$this->uri->segment(1) == 'penjualan' ? 'display: block;' : '' ?>">
    <li class="<?=$this->uri->segment(2) == 'index1' ? 'active' : '' ?>">
      <a href="<?=site_url('penjualan/index1')?>"><i class="fa fa-book"></i> Berdasarkan PO</a>
    </li>
    <li class="<?=$this->uri->segment(2) == 'index_item' ? 'active' : '' ?>">
      <a href="<?=site_url('penjualan/index_item')?>"><i class="fa fa-book"></i> Berdasarkan Item</a>
    </li>
  </ul>
</li>

<li class="treeview <?=$this->uri->segment(1) == 'permintaan' ? 'active menu-open' : '' ?>">
  <a href="#"><i class="fa fa-book"></i> Permintaan Stokis
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" style="<?=$this->uri->segment(1) == 'permintaan' ? 'display: block;' : '' ?>">
    <li class="<?=$this->uri->segment(2) == 'pesanan_lap_po_direk' ? 'active' : '' ?>">
      <a href="<?=site_url('permintaan/pesanan_lap_po_direk')?>"><i class="fa fa-book"></i> Berdasarkan PO</a>
    </li>
    <li class="<?=$this->uri->segment(2) == 'pesanan_lap_direk' ? 'active' : '' ?>">
      <a href="<?=site_url('permintaan/pesanan_lap_direk')?>"><i class="fa fa-book"></i> Berdasarkan Item</a>
    </li>
  </ul>
</li>


          <?php } ?> 
        
        
          <?php if($this->fungsi->user_login()->level == 5) { ?>
        <li class="header">Menu Admin</li>
        <li <?=$this->uri->segment(1) == 'user' ? 'class="active"' : '' ?>>
          <a href="<?=site_url('user')?>"><i class="fa fa-users"></i> <span>Akun</span></a></li>
          <li <?=$this->uri->segment(1) == 'stokis' ? 'class="active"' : '' ?>>
          <a href="<?=site_url('stokis')?>"><i class="fa fa-building-o"></i> <span>Stokis</span></a></li>
          <li <?=$this->uri->segment(1) == 'provinsi' ? 'class="active"' : '' ?>>
          <a href="<?=site_url('provinsi')?>"><i class="fa fa-map-marker"></i> <span>Provinsi</span></a></li>
          <li <?=$this->uri->segment(1) == 'level' ? 'class="active"' : '' ?>>
          <a href="<?=site_url('level')?>"><i class="fa fa-sitemap"></i> <span>Level</span></a></li>
          <?php } ?> 


  <li <?=$this->uri->segment(1) == 'user' ? 'class="active"' : '' ?>>
    <a href="<?= site_url('user/pass/' . $this->fungsi->user_login()->user_id) ?>">
        <i class="fa fa-key"></i> <span>Ubah Password</span>
    </a>
          <li <?=$this->uri->segment(1) == 'auth' ? 'class="active"' : '' ?>>
  <a href="#" data-toggle="modal" data-target="#logoutModal">
    <i class="fa fa-sign-out"></i> <span>Keluar</span>
  </a>
</li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php echo $contents ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script> 
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script>
function updateClock() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    const timeString = `${hours}:${minutes}:${seconds}`;
    document.getElementById('clock').textContent = timeString;
}

setInterval(updateClock, 1000);
updateClock(); // Run once on load
</script>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel"><strong>Konfirmasi Logout</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Apakah Anda yakin ingin <strong>logout?</strong></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="<?= site_url('auth/logout') ?>" class="btn btn-danger">Keluar</a>
      </div>
    </div>
  </div>
</div>
<!-- jQuery (required by Select2) -->


<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Inisialisasi Select2 -->
<script>
  $(document).ready(function() {
    $('#stokis_form').select2({
      placeholder: "== Pilih ==",
      allowClear: true
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#level_form').select2({
      placeholder: "== Pilih ==",
      allowClear: true
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#provinsi_form').select2({
      placeholder: "== Pilih ==",
      allowClear: true
    });
  });
</script>
</body>
<script>
  function updateJam() {
    const now = new Date();
    let jam = now.getHours().toString().padStart(2, '0');
    let menit = now.getMinutes().toString().padStart(2, '0');
    let detik = now.getSeconds().toString().padStart(2, '0');
    document.getElementById('jam').innerText = jam + ':' + menit + ':' + detik;
  }

  setInterval(updateJam, 1000);
  updateJam(); // panggil langsung saat load pertama
</script>

</html>
