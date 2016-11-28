<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 
function loginUser(){
  $CI = & get_instance();
  $sess = $CI->session->userdata('admin');
  $ar = unserialize($sess);
  $id=$ar['id'];
    $CI->load->model('admin_login_model');
  $details = $CI->admin_login_model->get($id);
 return $details->type;

 
}
?>