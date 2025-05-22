<?php

function ok(){
  $ci =& get_instance();
  $user_session  = $ci->session->userdata('userid');
  if($user_session){
    redirect('dashboard');
  }
}
function no(){
  $ci =& get_instance();
  $user_session  = $ci->session->userdata('userid');
  if(!$user_session){
    redirect('auth/login');
  }
}

function check_admin(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 5){
    redirect('splash_gagal_admin');
    exit;
  }
}
function check_finance(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 4){
    redirect('splash_gagal_finance');
    exit;
  }
}
function check_stokis(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 1){
    redirect('splash_gagal_stokis');
    exit;
  }
}
function check_mitra(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 2){
    redirect('splash_gagal_mitra'); 
    exit;
  }
}
function check_logistik(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 6){
    redirect('splash_gagal_logistik'); 
    exit;
  }
}

function check_direksi(){
  $ci =& get_instance();
  $ci->load->library('fungsi');
  
  if($ci->fungsi->user_login()->level != 8){
    redirect('splash_gagal_direksi'); 
    exit;
  }
}