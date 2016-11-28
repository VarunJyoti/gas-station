<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $get_settings->website_title; ?> | Dashboard</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/admin/build/css/custom.min.css" rel="stylesheet">
	
	<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/images/<?php echo $get_settings->site_favicon_icon;?>"/>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js"></script>
	<style>
   .help-inline{color:red;}
   .input-groups {
    margin-bottom: 10px;
    float: right;
	position: relative;
    display: table;
    border-collapse: separate;
}
   </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
	  
	  