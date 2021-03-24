<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" type="text/css" href="<?= base_url('style/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('style/css/all.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('style/css/owl.carousel.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('style/css/style.css'); ?>">


    <script type="text/javascript" src="<?= base_url('style/js/jquery-3.2.1.slim.min.js'); ?>"></script>

    <title>B612 Book Store | MY ACCOUNT</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('style/img/logo.png'); ?>">

</head>

<body>

    <div class="header-area">

        <div class="header-mid">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="logo">
                            <div class="lname"><a href="<?= base_url('home') ?>"><span><img src="<?= base_url('style/img/logo.png') ?>"> B612</span> Book Store</a></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                        <div class="col-md-9 text-center">
                                <div class="search-bar">
                                    <?= form_open('users/search') ?>
                                    <span class="sb"><input type="search" name="search" placeholder="Find your books"></span>
                                    <span class="sb"><input type="submit" value="Search"></span>
                                    <?= form_close() ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="ic-cart"><a href="<?= base_url() ?>cart"><i class="fas fa-shopping-cart"></i> Cart</a></div>


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
            <span><a href="<?= base_url() ?>home"><i class="fas fa-home"></i> Home</a></span>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12" style="min-height: 500px; margin-top: 3%;">
                <div class="row">
                    <div class="col-lg-2">

                        <div class="card card-body">
                            <hr>
                            <h3 style="text-align: center">Your Bag</h3>
                            <hr>
                            <div class="user-panel">
                                <a class="btn btn-primary dropdown-item waves-effect waves-light user-panel-button" href="">My Favorites</a>
                                <a class="btn btn-primary dropdown-item waves-effect waves-light user-panel-button" href="<?= base_url('user_account/user_orders')?>">My Orders</a>
                                <a class="btn btn-primary dropdown-item waves-effect waves-light user-panel-button" href="">Edit Profile</a>
                            </div>


                        </div>

                    </div>

                    <div class="col-lg-10">
                        <?php $this->load->view($user_view); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <div>
        <?php $this->load->view('include/footer'); ?>
    </div>