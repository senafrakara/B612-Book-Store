<?php
if ($this->session->flashdata('reg_success')) {
    print '<div class= "success-msg">' . $this->session->flashdata('reg_success') . '</div>';
}
if ($this->session->flashdata('reg_fail')) {
    print '<div class= "error-msg">' . $this->session->flashdata('reg_success') . '</div>';
}
?>

<div class="login-form-area">
    <div class="container">
        <div class="reg-form">
            <div class="form-header">Join Us</div>

            <?= form_open('users/registration') ?>

            <div class="form-group">
                <label for="name">Name</label>
                <?= form_input(['name' => 'name', 'placeholder' => 'Your name...', 'value' => set_value('name'), 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('name') ?></div>
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <?= form_input(['name' => 'surname', 'placeholder' => 'Your Surname...', 'value' => set_value('surname'), 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('surname') ?></div>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <?= form_input(['name' => 'contact', 'placeholder' => 'Phone number...', 'value' => set_value('contact'), 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('contact') ?></div>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <?= form_input(['name' => 'email', 'placeholder' => 'Your email...', 'value' => set_value('email'), 'class' => 'form-control']) ?>

                <div class="text-danger form-error"><?= form_error('email') ?></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <?= form_password(['name' => 'password', 'placeholder' => 'Password...', 'class' => 'form-control']) ?>

                    <div class="text-danger form-error"><?= form_error('password') ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="repassword">Confirm Password</label>
                    <?= form_password(['name' => 'repassword', 'placeholder' => 'Re-type Password...', 'class' => 'form-control']) ?>

                    <div class="text-danger form-error"><?= form_error('repassword') ?></div>
                </div>
            </div>

            <div class="form-group">
                <?= form_submit(['name' => 'submit', 'value' => 'Sign Up', 'class' => 'btn btn-primary my-btn']); ?>
            </div>
            <div class="form-group" id="acc">
                <span>Already have an account?</span>
                <a href="<?= base_url() ?>users/login">Login now</a>
            </div>
            <?= form_close() ?>

        </div>
    </div>
</div>