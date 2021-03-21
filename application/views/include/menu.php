<div class="menu-area">
    <div class="container">
        <div class="main-menu">
            <div class="row">
                <div class="col-lg-2 col-md-3">

                    <div class="dropdown show onclick-ctg">
                        <a class="ctg-btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                            Categories <span id="m-list"><i class="fas fa-list"></i></span>
                        </a>
                
                        <div class="dropdown-menu">
                            <ul>
                                <?php foreach ($categories as $cat) : ?>

                                    <?php print '<li><a href="'.base_url('users/allBooks').'/?cat='.$cat->tag.'">' . $cat->category . '</a></li>'; ?>

                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9">
                    <div class="menu">
                        <ul id="nav">
                            <li><a href="<?= base_url()?>home">Home</a></li>
                            <li><a href="<?= base_url()?>users/allBooks">Books <i class="fas fa-book"></i></a></li>
                            <li><a href="<?= base_url()?>users/allEBooks">E-books <i class="fas fa-file"></i></a></li>


                            <li><a href="#" data-toggle="modal" data-target="#exampleModal">Contact Us</a></li>
                            <?php

                          
                            ?>

                            <li><a href="#" data-toggle="modal" data-target="#aboutModal">About Us</a></li>
                            <?php

                            ?>

                            <?php if ($this->session->userdata('type') == 'A') : ?>
                                <li class="btn-user"><a href="<?= base_url() ?>admin"><i class="fas fa-tools"></i> Admin panel</a></li> <!-- redirection according to the user type -->
                            <?php endif; ?>

                            <?php $type = $this->session->userdata('type') ?>
                            <?php if ($type == 'U') : ?>
                                <li class="btn-user"><a href=""><i class="far fa-user"></i> My account</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>