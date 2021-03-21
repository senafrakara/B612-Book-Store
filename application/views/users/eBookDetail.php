<br>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div id="table-header"></div>
            <div class="ebooks-menu">
                <ul>
                    <?php foreach ($categories as $cat) : ?>

                        <?php print '<li><a href="' . base_url('users/allEBooks') . '/?cat=' . $cat->id . '">' . $cat->category . '</a></li>'; ?>

                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div id="table-header" style="font-size: 25px !important;"><?= strip_tags($eBookDetail->ebook_name) ?></div><br>
            <div class="row">
                <div class="col-sm-8">
                    <table class="table">
                        <tr>
                            <th>Author</th>
                            <td colspan="1"><span><?= strip_tags($eBookDetail->author) ?></span></td>
                        </tr>

                        <tr class="border-bottom">
                            <th>Category</th>
                            <td colspan="1"><?= strip_tags($eBookDetail->category) ?></td>
                        </tr>
                    </table>
                    <div><b>Book Description</b></div><br>
                    <p><?= nl2br(strip_tags($eBookDetail->description)) ?></p>
                </div>
                <div class="col-sm-4" id="book-img"><?php echo '<img src = "' . strip_tags($eBookDetail->book_image) . '" alt = "">'; ?></div>

            </div>


            <a href="<?= $eBookDetail->book_file ?>" target="_blank" class="btn btn-success">Download</a>

        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
<br>