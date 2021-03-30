<br>
<?php
if ($this->session->flashdata('success')) {
    print '<div class= "success-msg">' . $this->session->flashdata('success') . '</div>';
}
if ($this->session->flashdata('error')) {
    print '<div class= "error-msg">' . $this->session->flashdata('error') . '</div>';
}
?>

<style>
    i.fa.fa-thumbs-down {
        display: none;
    }

    i.fa.fa-thumbs-up {
        display: none;
    }

    svg.bi.bi-heart-fill {
        margin-left: 5px;
        width: 17px;
        height: 17px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12" id="book-detail">
            <div id="table-header"><?= strip_tags($bookDetail->book_name) ?></div><br>


            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6" id="book-img">
                    <div class="main-image">
                        <?php print '<img src = "' . strip_tags($bookDetail->book_image) . '" alt = "">'; ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="book-info">
                        <div><?= strip_tags($bookDetail->book_name) ?></div>
                        <div><span>Author: <span><?= strip_tags($bookDetail->author) ?></span></span></div>
                        <div><span>Publisher: <span><?= strip_tags($bookDetail->publisher) ?></span> <span></div>
                        <div><span>Category: <span><?= strip_tags($bookDetail->category) ?></p></span></span></div>
                        <div class="price"> <?= strip_tags($bookDetail->price) ?> TL</div>
                    </div>

                    <div><?php print '<a href="' . base_url('cart/addCart/'). $bookDetail->id . '" class="btn btn-outline-success btn-sm btn-add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</a>'; ?></div>
                    <?php if ($this->session->userdata('id')) : ?>
                        <form action="<?=base_url() . 'user_account/favoriteBook/' . $bookDetail->id?>" method="POST">

                            <!-- if user added into favorite  -->
                            <?php if ($isFavorite) : ?>
                                <!--If user is logged in and if it did favorite this product before-->
                                <button type="submit" name="product_id" value="<?= $bookDetail->id ?>" class="btn btn-danger btn-md">
                                    Remove from Favorites<i onclick="FavoriteUp(this)" class="fa fa-thumbs-down" style="display: none;"></i>
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-left: 5px;width: 17px;height: 17px;">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </button>
                                <!-- if user not added to favorite -->
                            <?php else : ?>
                               
                                <button type="submit" name="product_id" value="<?= $bookDetail->id ?>" class="btn btn-primary btn-md">
                                    Add to Favorites<i onclick="FavoriteDown(this)" class="fa fa-thumbs-up" style="display: none;"></i>
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-left: 5px;width: 17px;height: 17px;">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </button>
                            <?php endif; ?>
                      
                
                        </form>
                    <?php endif; ?>

                </div>
            </div>

            <br>
            <div class="book-description">
                <hr>
                <p><?= nl2br(htmlentities($bookDetail->description)) ?></p>
            </div>
            <hr>

            <?php if ($this->session->userdata('logged_in')) {
                $this->load->view("users/commentForm");
            } else {
                print '<div><p>Please log in to make a comment. <a href="' . base_url('users/login') . '" class = "btn-login">Login</a></p></div>';
            }
            ?>

        </div>
        <div class="col-lg-4 col-md-3">

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php $this->load->view("users/commentsField"); ?>
        </div>
    </div>

</div>

<script>
    // $(document).ready(function() {
    //     // MDB Lightbox Init
    //     $(function() {
    //         $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
    //     });
    // });

    function FavoriteDown(x) {
        x.classList.toggle("fa-thumbs-down");
    }

    function FavoriteUp(x) {
        x.classList.toggle("fa-thumbs-up");
    }
</script>