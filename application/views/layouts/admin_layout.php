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
    <script type="text/javascript" src="<?= base_url('style/js/jquery-3.2.1.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('style/js/jquery-3.2.1.min.js'); ?>"></script>

    <title>B612 Boook Store | Admin Panel</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('style/img/logo.png'); ?>">
</head>

<body>
    <div class="header-area">

        <div class="header-mid">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="logo">
                            <div class="lname"><a href="<?= base_url('home') ?>"><span><img src="<?= base_url('style/img/logo.png') ?>"> B612</span> Book Store</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <div class="ic-cart"><a href="<?= base_url('cart');?>"><i class="fas fa-shopping-cart"></i> Cart</a></div>
                                <?php if ($this->cart->contents()) : ?>
                                    <div class="cart-count">
                                        <div>
                                            <?php $rows = count($this->cart->contents());
                                            print $rows; ?>
                                        </div>
                                    </div>
                                <?php elseif ($this->session->userdata('id')) : ?>
                                    <div class="cart-count">
                                        <div>
                                            <?php
                                            if ($this->session->userdata('id')) {
                                                $this->load->model('user_model');
                                                $countCartItems = $this->user_model->getCartItemCount();
                                                print $countCartItems->count;
                                            } ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="admin-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-3 admin-nav">
                    <?php $this->load->view('admin/nav_bar_admin'); ?>
                </div>
                <div class="col-md-10 col-sm-9">
                    <div class="single-header-a">
                        <div class="container">
                            <span><a href="<?= base_url() ?>home"><i class="fas fa-home"></i> Home</a> /
                                <a href="<?= base_url() ?>admin">Admin Panel</a></span>
                        </div>
                    </div>
                    <?php if ($admin_view == "include/404" || $admin_view == "include/404noOrder") : ?>
                        <div class="row justify-content-center">
                            <div>
                                <?php $this->load->view($admin_view); ?><br>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php $this->load->view($admin_view); ?><br>
                    <?php endif; ?>

                    <div>
                        <?php $this->load->view('include/footer'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>