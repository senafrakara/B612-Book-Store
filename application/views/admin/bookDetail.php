<div class="container">
    <div class="row">
        <div class="col-sm-8 col-xs-12" id="book-detail">
            <div id="table-header"><?= strip_tags($book_detail->book_name) ?></div><br> 
            <!-- book_detail comes from admin controller->allBooks functions, we give the book_detail as argument as data to this view-->

            <div class="row">
                <div class="col-sm-4" id="book-img"><?php echo '<img src = "' . strip_tags($book_detail->book_image) . '" alt = "">'; ?></div>
                <div class="col-sm-8">
                    <div class="book-info">
                    
                        <div>Author: <?= strip_tags($book_detail->author) ?></div>
                        <div>Publisher: <?= strip_tags($book_detail->publisher) ?></div>
                        <div>Category: <?= strip_tags($book_detail->category) ?></div>
                        <div>
                            <?php
                            if ($book_detail->status == '1') {
                                echo "Status: <span class = 'text-success'>Published</span>";
                            } else {
                                echo "Status: <span class = 'text-danger'>Unpublished</span>";
                            }
                            ?>
                        </div>
                        <div>
                            <h5>Price: <?= strip_tags($book_detail->price) ?> TL</h5>
                        </div>
                        <?php if ($book_detail->quantity > 0) : ?>
                            <div class="text-success"> <i class="fas fa-check-circle"></i> In stock: <?= strip_tags($book_detail->quantity) ?></div>
                        <?php else : ?>
                            <div class="text-error"> <i class="fas fa-check-circle"></i> Out of stock: <?= strip_tags($book_detail->quantity) ?></div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <br>
            <div class="book-description">
                <h5>Book description</h5>
                <hr>
                <p><?= nl2br(strip_tags($book_detail->description)) ?></p>
            </div>
            <hr>
            <div>
                <h5>Action</h5>
            </div>
            <?php echo '<td>';
            echo '<a href= "' . base_url() . 'admin/editBook/' . $book_detail->id . '" title= "Edit" class="btn btn-success btn-sm"> <i class= "fas fa-wrench"></i> Update</a>&nbsp';
            echo '<a href= "' . base_url() . 'admin/deleteBook/' . $book_detail->id . '" title= "Delete" class="btn btn-danger btn-sm delete" data-confirm = "Are you sure to delete this book?"> <i class= "fas fa-trash"></i> Delete</a>&nbsp';

            echo '</td>';
            ?>
        </div>
        <div class="col-sm-4">

        </div>
    </div>
</div>
<br>