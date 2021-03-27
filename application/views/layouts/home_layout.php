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

    <title>B612 Book Store | Discover New Worlds</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('style/img/logo.png'); ?>">
</head>

<body>

    <div class="header-area">
        <div class="header-mid">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="logo">
                            <div class="lname"><a href=""><span><img src="<?= base_url('style/img/logo.png') ?>"> B612</span> Book Shop</a></div>
                        </div>
                    </div>
                    <div class="col-md-8">
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
                                <div class="ic-cart"><a href="<?= base_url() ?>"><i class="fas fa-shopping-cart"></i> Cart</a></div>

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

    <?php
    if ($this->session->flashdata('login_success')) {
        print '<div class= "success-msg">';
        print '<div class = "container">' . $this->session->flashdata('login_success') . '</div>';
        print '<div class="cross"><a href="" class="text-success"><i class="fas fa-times"></i></a></div>';
        print '</div>';
    }
    if ($this->session->flashdata('login_fail')) {
        print '<div class= "error-msg">';
        print '<div class = "container">' . $this->session->flashdata('login_fail') . '</div>';
        print '<div class="cross"><a href="" class="text-success"><i class="fas fa-times"></i></a></div>';
        print '</div>';
    }
    ?>


    <div>
        <?php $this->load->view('include/slider'); ?>
    </div>

    <?php foreach ($categories as $cat) : ?>

        <?php if ($cat->category == 'Science') {
            $scienceTag = $cat->tag;
        } elseif ($cat->category == 'Novel') {
            $novelTag = $cat->tag;
        } elseif ($cat->category == 'Literature') {
            $literatureTag = $cat->tag;
        }

        ?>

    <?php endforeach; ?>

    <div class="section-padding after-slider">
        <div class="container">
            <div class="section-title"><a href="<?= base_url('users/allBooks') ?>">Recent Books</a></div>
            <div><?php
                    $this->load->view('include/recentBooks')
                    ?></div>
        </div>
    </div>

    <div class="section-padding">
        <div class="container">
            <div class="section-title"><a href="<?= base_url('users/allBooks/?cat=' . $literatureTag . '') ?>">Literature</a></div>
            <div><?php
                    $this->load->view('include/literatureBooks')
                    ?></div>
        </div>
    </div>
    <div class="section-padding">
        <div class="container">
            <div class="section-title"><a href="<?= base_url('users/allBooks/?cat=' . $scienceTag . '') ?>">Science</a></div>
            <div><?php
                    $this->load->view('include/scienceBooks')

                    ?></div>
        </div>
    </div>
    <div class="section-padding">
        <div class="container">
            <div class="section-title"><a href="<?= base_url('users/allBooks/?cat=' . $novelTag . '') ?>">Novel</a></div>
            <div><?php
                    $this->load->view('include/novelBooks')
                    ?></div>
        </div>
    </div>

    <div class="footer-area-home">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget">
                        <div class="brand-name">
                            <div class="lname"><a href=""><span>B612 </span>Book Shop</a></div>
                            <p>B216 Book Shop is a online books market place, you can buy your favourite books. You can also find here different types of e-books and you can download these books free.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget">
                        <h3>Services</h3>

                        <ul>
                            <li><a href="<?= base_url('') ?>">Buy Books</a></li>
                            <li><a href="<?= base_url('') ?>">Find E-books</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget">
                        <h3>Contact</h3>
                        <p>Communication is very much important for building good customer relationship. You are always welcome.</p>
                        <div id="social-icon">
                            <span><a href="https://github.com/senafrakara" title="Github" target="_blank"><i class="fab fa-github"></i></a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right">
                <p><i class="fas fa-copyright"></i> 2021 Nursena <br>All right reserved</p>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="<?= base_url('style/js/popper-1.12.9.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('style/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('style/js/all.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('style/js/owl.carousel.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('style/js/main.js'); ?>"></script>

</body>

</html>