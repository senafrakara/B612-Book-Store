<?= form_open("users/bookDetail/".$this->uri->segment(3)."")?>
    <div class="form-group row">
      <p class="leave-review">Leave a comment</p>
        <div class="col-md-10 col-sm-10">
            <?= form_textarea(['name'=>'comment', 'placeholder'=>'Comment',  'value'=>set_value('comment'), 'class'=>'form-control', 'rows'=>'3'])?>
             <div class="text-danger form-error"><?= form_error('comment')?></div>
        </div>
        <div class="col-md-2 col-sm-2">
            <?= form_submit(['name'=>'submit', 'value'=>'Comment', 'class'=>'btn btn-success'])?>
        </div>
    </div>
<?= form_close()?>
