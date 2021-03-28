<div class="forgot-pwd-area">
    <div class="login-form-area col-lg-6">
        <div class="container">
            <div class="forgotpwd-form">
                <div class="form-header">Reset Password</div>
                <div class="row">
                    <div class="col-lg-12">

                        <?= form_open( base_url('users/ForgotPassword')); ?>
                        <div class="form-group">
                            <label for="email"><b>Email</b></label>

                            <?= form_input(['name' => 'email', 'placeholder' => 'Enter your email', 'value' => set_value('email'), 'class' => 'form-control']); ?>

                            <?= form_error('email', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <?= form_submit(['name' => 'submit', 'value' => 'Send an email', 'class' => 'btn btn-primary my-btn login-btn']); ?>&nbsp

                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>