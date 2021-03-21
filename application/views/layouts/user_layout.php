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

    <title>B612 Book Store | User pages</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('style/img/logo.png'); ?>">
</head>

<body>

    <div class="header-area">

        <div class="header-mid">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="logo">
                            <div class="lname"><a href="<?= base_url() ?>home"><span><img src="<?= base_url('style/img/logo.png') ?>"> B612</span> Book Store</a></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-9 text-center">
                                <?php if ($this->session->userdata('logged_in') == FALSE) : ?>

                                    <a href="<?= base_url() ?>users/login" class="btn-login"><i class="fas fa-sign-in-alt"></i> Login</a>
                                    <a href="<?= base_url() ?>users/registration" class="btn-login"><i class="fas fa-user-cog"></i> Register</a>

                                <?php endif; ?>
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
            <div class="col-lg-12 col-md-12 col-sm-12" style="min-height: 500px">
                <?php $this->load->view($user_view); ?>
                <!-- comes from users controller with login or registration etc. -->
            </div>
        </div>
    </div>



    <div>
        <?php $this->load->view('include/footer'); ?>
    </div>