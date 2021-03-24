<br><div id="table-header" style="text-align: center;">Results
</div><br>


<div class="row con-flex">

<?php if(!$books): ?>
	<div><h6 class="text-danger">No books found related to your search.</h6></div>
	<?php else: ?>
    <?php foreach ($books as $book) : ?>
        <div class="col-lg-2 col-md-3 col-sm-4">
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
<?php endif; ?>
 