<br>
<div id="table-header">All Books
    <?php foreach ($categories as $cat) : ?>
        <?php
        if (isset($_GET['cat'])) {
            if ($_GET['cat'] == $cat->tag) {
                print '<i class="fas fa-angle-double-right" style="color: #ddd"></i> ' . $cat->category;
            }
        }
        ?>
    <?php endforeach; ?>
</div><br>

<div class="row con-flex">
    <?php foreach ($books as $book) : ?>
        <div class="col-lg-3 col-md-4 col-sm-5">
            <div id="single-book">
                <div id="book-image">
                    <?php print '<img src = "' . strip_tags($book->book_image) . '" alt = "">'; ?>
                </div>
              
                <?php print '<div id="addto-cart"><a href=""><i class="fas fa-shopping-cart"></i> Add to cart</a></div>'; ?>

                <div class="book-text">
                    <div id="book-name"><?= substr($book->book_name, 0, 21) ?></div>
                    <div id="author">By <i><?= $book->author ?></i></div>
                    <div id="price"><?= $book->price ?> TL </div>
                    <div id="book-details"><?php print '<a href = "'.base_url().'users/bookDetail/'.$book->id.'">Detail</a>'; ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div><br>


<?php if (!isset($_GET['cat'])) : ?>
    <div class="paginataion section-padding">
        <?= $this->pagination->create_links() ?>
    </div>
<?php endif; ?>