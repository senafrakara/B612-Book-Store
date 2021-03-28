<?php
if ($this->session->flashdata('msg')) {
    print '<div class= "success-msg">' . $this->session->flashdata('msg') . '</div>';
}

if ($this->session->flashdata('msg_fail')) {
    print '<div class= "error-msg">' . $this->session->flashdata('msg_fail') . '</div>';
}

?>

<div class="login-form-area">
    <div class="container">
        <div class="login-form">
            <div class="form-header">Contact</div>
            <div class="row">
                <div class="col-lg-6">
                    <?= form_open('users/contactUs'); ?>
                    <div class="form-group">
                        <label for="email"><b>Email</b></label>

                        <?= form_input(['name' => 'email', 'placeholder' => 'Enter your email', 'value' => set_value('email'), 'class' => 'form-control']); ?>

                        <?= form_error('email', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <?= form_input(['name' => 'name', 'placeholder' => 'Your name', 'value' => set_value('name'), 'class' => 'form-control']) ?>

                        <div class="text-danger form-error"><?= form_error('name') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <?= form_input(['name' => 'subject', 'placeholder' => 'Your subject', 'value' => set_value('subject'), 'class' => 'form-control']) ?>

                        <div class="text-danger form-error"><?= form_error('subject') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <?= form_textarea(['name' => 'message', 'placeholder' => 'Your message here', 'value' => set_value('message'), 'class' => 'form-control', 'rows' => '4']) ?>

                        <div class="text-danger form-error"><?= form_error('subject') ?></div>
                    </div>

                    <div class="form-group">
                        <?= form_submit(['name' => 'submit', 'value' => 'Send', 'class' => 'btn btn-primary my-btn login-btn']); ?>&nbsp

                    </div>

                    <?= form_close(); ?>
                </div>

            </div>
        </div>
    </div>
</div>