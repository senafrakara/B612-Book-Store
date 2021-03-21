<br>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div id="table-header" style="font-size: 25px !important;"><?= strip_tags($ebookDetail->ebook_name) ?></div><br>
            <div class="row">
                <div class="col-sm-8">
                    <table class="table">
                        <tr>
                            <th>Author</th>
                            <td colspan="1"><span><?= strip_tags($ebookDetail->author) ?></span></td>
                        </tr>
                        <tr>
                            <th>Book file</th>
                            <td colspan="1"><a href="<?= $ebookDetail->book_file ?>" target="_blank"><span><?= strip_tags($ebookDetail->ebook_name) ?>/<?= strip_tags($ebookDetail->author) ?></span></a></td>
                        </tr>
                        <tr class="border-bottom">
                            <th>Category</th>
                            <td colspan="1"><?= strip_tags($ebookDetail->category) ?></td>
                        </tr>
                    </table>
                    <div><b>Book Description</b></div><br>
                    <p><?= nl2br(strip_tags($ebookDetail->description)) ?></p>
                </div>
                <div class="col-sm-4" id="book-img"><?php echo '<img src = "' . strip_tags($ebookDetail->book_image) . '" alt = "">'; ?></div>

            </div>

            <div>
                <h5>Action</h5>
            </div>
            <?php print '<td>';
            print '<a href= "' . base_url('admin/deleteEBook/' . $ebookDetail->id . '') . '" title= "Delete" class="btn btn-danger btn-sm delete" data-confirm = "Are you sure to delete this e-book?"> <i class= "fas fa-trash"></i> Delete</a>&nbsp';
            print '<a href= "' . base_url() . 'admin/editEBook/' . $ebookDetail->id . '" title= "Edit" class="btn btn-success btn-sm"> <i class= "fas fa-wrench"></i> Update</a>&nbsp';
            print '</td>';
            ?>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
<br>