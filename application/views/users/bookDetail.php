<br>
<?php
if ($this->session->flashdata('success')) {
    print '<div class= "success-msg">' . $this->session->flashdata('success') . '</div>';
}
if ($this->session->flashdata('error')) {
    print '<div class= "error-msg">' . $this->session->flashdata('error') . '</div>';
}
?>


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

                    <div><?php print '<a href="" class="btn btn-outline-success btn-sm btn-add-to-cart"><i class="fas fa-shopping-cart"></i> Add to cart</a>'; ?></div>


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