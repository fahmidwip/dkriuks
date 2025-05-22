<?php

function ok(){
  $ci =& get_instance();
  $user_session  = $ci->session->userdata('usersid');
  if($user_session){
    redirect('dashboard');
  }
}
function no(){
  $ci =& get_instance();
  $user_session  = $ci->session->userdata('usersid');
  if(!$user_session){
    redirect('auth/login');
  }
}

function check_admin(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 5){
    echo "<script>
            alert('Mohon maaf hanya untuk Admin');
            window.location.href='" . base_url('dashboard') . "';
          </script>";
    exit;
  }
}
function check_finance(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 4){
    echo "<script>
            alert('Mohon maaf hanya untuk Finance');
            window.location.href='" . base_url('dashboard') . "';
          </script>";
    exit;
  }
}
function check_stokis(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 1){
    redirect('splash_gagal_mitra'); // arahkan ke halaman splash screen gagal
    exit;
  }
}
function check_mitra(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 2){
    redirect('splash_gagal_mitra'); // arahkan ke halaman splash screen gagal
    exit;
  }
}