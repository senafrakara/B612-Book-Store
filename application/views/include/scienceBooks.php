<div class="row con-flex">
    <?php foreach ($scienceBooks as $book) : ?>
        <div class="col-lg-3 col-md-4 col-sm-5">
            <div id="single-book">
                <div id="book-image">
                    <?php print '<img src = "' . strip_tags($book->book_image) . '" alt = "">'; ?>


                    <?php print '<div id="addto-cart"><a href="' . base_url() . 'cart/add_to_cart/' . $book->id . '"><i class="fas fa-shopping-cart"></i> Add to cart</a></div>'; ?>

                </div>
                <div class="book-text">
                    <div id="book-name"><?= substr(htmlentities($book->book_name), 0, 20) ?></div>
                    <div id="author"><i><?= $book->author ?></i></div>
                    <div id="price"><?= $book->price ?> TL</div>
                    <div id="book-details">
                        <?php print '<a href = "' . base_url() . 'users/bookDetail/' . $book->id . '">View</a>'; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>