<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  body {
    display: flex;
    justify-content: center;
    align-items: center;
    background: url(<?php echo base_url(); ?>assets/dist/img/t.png) no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    
  }

  .kotak_login {
    width: 100%;
    max-width: 360px;
    background: #ffffff;
    padding: 30px 25px;
    margin: auto;
    box-shadow: 25px 25px 100px rgba(0, 0, 0, 0.15);
    border-radius: 18px;
    text-align: center;
  }

  .kotak_login img.gambar {
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    background-color: #888888;
  box-shadow: 4px 4px #888888;
  border-radius: 12px;
  }

  .login-box-msg {
    font-weight: 600;
    font-size: 16px;
    color: #333;
    margin-bottom: 25px;
    
  }

  .form-group input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 20px;
    transition: all 0.3s ease-in-out;
    
  }

  .form-group input:focus {
    border-color: #FF0000;
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.1);
    
  }

  .tombol_login {
    background: #FF0000;
    color: #fff;
    border: none;
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    font-size: 14px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
  }

  .tombol_login:hover {
    background: #cc0000;
  }

  .link {
    display: block;
    margin-top: 15px;
    font-size: 12px;
    color: #666;
    text-decoration: none;
  }

  .link:hover {
    color: #FF0000;
  }

  @media (max-width: 480px) {
    .kotak_login {
      padding: 20px 15px;
    }
  }
  .jam-digital {
  position: fixed;
  top: 10px;
  right: 20px;
  color: white;
  font-size: 18px;
  font-weight: bold;
  font-family: 'Poppins', sans-serif;
  background-color: rgba(0, 0, 0, 0.5);
  padding: 8px 12px;
  border-radius: 8px;
  z-index: 9999;
}
@keyframes fadeSlideUp {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.kotak_login {
  animation: fadeSlideUp 1s ease-out forwards;
  opacity: 0;
}
</style>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dkriuk Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/square/blue.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="body">
<div class="jam-digital" id="jam"></div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="kotak_login">
  <div class="form_login">
  <center><img src="<?=base_url()?>assets/dist/img/dkriuklogobaru2025.jpg" alt="User Image" width="190" height="80" class="gambar"></center><br>
    <p class="login-box-msg">Silahkan Login</p>

    <form action="<?=site_url('auth/process')?>" method="post">
    <div class="form-group has-feedback">
        <input type="text" name="kode" class="form-control" placeholder="User Login" required>
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            
          </div>
        </div>
        
        <div class="col-xs-4">
        <button type="submit" name="login" class="tombol_login" disabled title="Harap isi kode dan password terlebih dahulu">Masuk</button>


        </div>
        <!-- /.col -->
      </div>

    </form>

  </div>

  <!-- /.login-box-body -->
</div>
<div class="login-box">
<marquee behavior="scroll" direction="left" style="color: white; font-size: 12px; font-family: 'Poppins', sans-serif; background-color: transparent; padding: 1px 0;">
  Selamat Datang, Aplikasi Pemesanan Bahan Baku Dkriuk
</marquee>

<!-- /.login-box -->
</div>

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
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
  updateJam(); 
</script>
<script>
  $(document).ready(function() {
    setTimeout(function() {
      $('.kotak_login').css('opacity', '1').css('animation', 'fadeSlideUp 1s ease-out forwards');
    }, 250); 
  });
</script>

<script>
  $(document).ready(function () {
    const $kode = $('input[name="kode"]');
    const $password = $('input[name="password"]');
    const $submitBtn = $('.tombol_login');

    function toggleButton() {
      if ($kode.val().trim() !== "" && $password.val().trim() !== "") {
        $submitBtn.prop('disabled', false);
        $submitBtn.removeAttr('title'); // Hapus pesan jika sudah bisa diklik
      } else {
        $submitBtn.prop('disabled', true);
        $submitBtn.attr('title', 'Harap isi kode dan password terlebih dahulu');
      }
    }

    $kode.on('input', toggleButton);
    $password.on('input', toggleButton);

    toggleButton(); // Set initial state

    // Optional: tooltip muncul saat hover meskipun tombol disabled
    $submitBtn.on('mouseenter', function () {
      if ($(this).is(':disabled')) {
        $(this).tooltip({ placement: 'top' }).tooltip('show');
      }
    });
  });
</script>



</html>
