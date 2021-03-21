<div class="container-fluid">

    <div class="view-btn">
        <a href="<?= base_url() ?>admin/allEBooks" style="margin-right:2rem;">All e-books <i class="fas fa-book"></i></a>
        <a href="<?= base_url() ?>admin/addEBook">Add new e-book <i class="fas fa-plus-circle"></i></a>
    </div>
</div>

<div class="container">
    <div class="my-form">
        <div id="form-header">Add E-Book</div>
        <?= form_open_multipart("admin/addEBook") ?>
        <div class="form-group row">
            <label for="ebook-name" class="col-sm-2 col-form-label">Book Name</label>
            <div class="col-sm-6">
                <?= form_input(['name' => 'ebook_name', 'placeholder' => 'Book Name', 'value' => set_value('ebook_name'), 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-4">
                <div class="text-danger form-error"><?= form_error('ebook_name') ?></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-6">
                <?= form_textarea(['name' => 'description', 'placeholder' => 'Book Description',  'value' => set_value('description'), 'class' => 'form-control', 'rows' => '5']) ?>
            </div>
            <div class="col-md-4">
                <div class="text-danger form-error"><?= form_error('description') ?></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-6">
                <?= form_input(['name' => 'author', 'placeholder' => 'Author Name', 'value' => set_value('author'), 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-4">
                <div class="text-danger form-error"><?= form_error('author') ?></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-6">
                <select name="categoryId" class="form-control">
                    <option value="">Choose...</option>
                    <?php foreach ($category as $cat) : ?>
                        <?php print '<option value="' . $cat->id . '">' . $cat->category . '</option>'; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-4">
                <div class="text-danger form-error"><?= form_error('categoryId') ?></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="book_image" class="col-sm-2 col-form-label">Book image</label>
            <div class="col-sm-6">
                <?= form_upload(['name' => 'userfile2', 'class' => 'form-control', 'id' => 'book_image']) ?>
                <div class="text-secondary">* Upload PNG, JPG format. Image should not be more than 400KB</div>
            </div>
            <?php if (isset($upload_errors)) { ?>
                <div class="col-sm-4">
                    <div class="text-danger form-error"><?php echo $upload_errors; ?></div>
                </div>
            <?php } ?>
        </div>

        <div class="form-group row">
            <label for="book_file" class="col-sm-2 col-form-label">Book File</label>
            <div class="col-sm-6">
                <?= form_upload(['name' => 'userfile3', 'class' => 'form-control', 'id' => 'book_file']) ?>
                <div class="text-secondary">* Upload pdf format. file should not be more than 5MB</div>
            </div>
            <?php if (isset($upload_errors)) { ?>
                <div class="col-sm-4">
                    <div class="text-danger form-error"><?php echo $upload_errors; ?></div>
                </div>
            <?php } ?>
        </div>

        <div class="sub">
            <span><?= form_submit(['name' => 'submit', 'value' => 'Add E-Book', 'class' => 'btn btn-primary btn-sm my-btn']) ?></span>
            <span><?= form_reset(['name' => 'reset', 'value' => 'Reset', 'class' => 'btn btn-danger btn-sm my-btn-res']) ?></span>
        </div>
        </form>
    </div>
</div>