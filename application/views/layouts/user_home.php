<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" type="text/css" href="<?= base_url('style/css/bootstrap.min.css'); ?>">
>
    <link rel="stylesheet" type="text/css" href="<?= base_url('style/css/all.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('style/css/owl.carousel.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('style/css/style.css'); ?>">
    

    <script type="text/javascript" src="<?= base_url('style/js/jquery-3.2.1.slim.min.js'); ?>"></script>

    <title>B612 Book Store | Discover New Worlds</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('style/img/logo.png'); ?>">
    
</head>

<body>

    <div class="header-area">
      
        <div class="header-mid">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="logo">
                            <div class="lname"><a href="<?= base_url()?>home"><span><img src="<?= base_url('style/img/logo.png') ?>"> B612</span> Book Store</a></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-9">
                              <div class="admin-search">
                         
                              </div>
                            </div>
                            <div class="col-md-3">
                                <div class="ic-cart"><a href="<?= base_url()?>cart"><i class="fas fa-shopping-cart"></i> Cart</a></div>
                     
                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
        <div>
            <?php $this->load->view('include/menu'); ?>
        </div>
    </div>
  
    <div class="single-header-u">
        <div class="container">
            <span><a href="<?= base_url()?>home"><i class="fas fa-home"></i> Home</a></span>
        </div>
    </div>
    <div class="user-menu-area">
        <div class="container">
            <div class="user-menu">
            <ul>
                <li><a href="">My books</a></li>
                <li><a href="">My orders</a></li>
                <li><a href="">Edit profile</a></li>
                <li><a href="<?= base_url()?>users/logout"><i class="fas fa-power-off"></i> Logout</a></li>
            </ul>
            </div>
        </div>
    </div>
 
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12" style="min-height: 500px">
                <?php $this->load->view($user_view); ?>
            </div>
        </div>
    </div>




    <div>
        <?php $this->load->view('include/footer'); ?>
    </div>
