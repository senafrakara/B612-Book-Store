<div class="account-info">
    <div class="row">
        <div class="col-lg-6">

            <?= form_open('user_account/editAccount/') ?>
            <div id="form-header" style="text-align:center;">Account Settings</div><br>

            <div class="form-group col-md-12">
                <label for="name">Name</label>
                <?= form_input(['name' => 'name', 'placeholder' => 'Your name', 'value' => set_value('name', $userDetail->name), 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('name') ?></div>
            </div>
            <div class="form-group col-md-12">
                <label for="name">Surname</label>
                <?= form_input(['name' => 'surname', 'placeholder' => 'Your surname', 'value' => set_value('surname', $userDetail->surname), 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('surname') ?></div>
            </div>
            <div class="form-group col-md-12">
                <label for="contact">Email</label>
                <?= form_input(['name' => 'email', 'placeholder' => 'Your email address', 'value' => set_value('email', $userDetail->email), 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('email') ?></div>
            </div>
            <div class="form-group col-md-12">
                <label for="contact">Contact</label>
                <?= form_input(['name' => 'contact', 'placeholder' => 'Your phone number', 'value' => set_value('contact', $userDetail->contact), 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('contact') ?></div>
            </div>

            <div class="form-group col-md-12">
                <?= form_submit(['name' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary btn-sm my-btn']); ?>
      
            </div>

            <?= form_close() ?>

        </div>
        <div class="divider"></div>
        <div class="col-lg-5">
            <?= form_open('user_account/changePassword/') ?>
            <div id="form-header" style="text-align:center;">Change Pasword</div><br>
            <div class="form-group col-md-12">
                <label for="password">Password</label>
                <?= form_password(['name' => 'password', 'placeholder' => 'Password', 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('password') ?></div>
            </div>
            <div class="form-group col-md-12">
                <label for="repassword">Confirm Password</label>
                <?= form_password(['name' => 'repassword', 'placeholder' => 'Re-type Password', 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('repassword') ?></div>
            </div>

            <div class="form-group">
                <?= form_submit(['name' => 'submit', 'value' => 'Change', 'class' => 'btn btn-primary btn-sm my-btn']); ?>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<br>