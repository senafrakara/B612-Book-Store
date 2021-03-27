<div class="container">
<h2>Contact</h2>
<div class="row">
    <div class="col-lg-6">
        <?php echo $this->session->flashdata('msg'); ?>
        <form action="<?php echo base_url('users/contactUs'); ?>" method="post">
        <div class="form-group">
            <input name="name" placeholder="Your name" type="text" value="<?php echo set_value('name'); ?>" class="form-control" />
            <?php echo form_error('name', '<span class="text-danger">','</span>'); ?>
        </div>
        <div class="form-group">
            <input name="email" placeholder="Your e-mail" type="text" value="<?php echo set_value('email'); ?>" class="form-control" />
            <?php echo form_error('email', '<span class="text-danger">','</span>'); ?>
        </div>
        <div class="form-group">
            <input name="subject" placeholder="Subject" type="text" value="<?php echo set_value('subject'); ?>" class="form-control" />
        </div>
        <div class="form-group">
            <textarea name="message" rows="4" class="form-control" placeholder="Your message"><?php echo set_value('message'); ?></textarea>
            <?php echo form_error('message', '<span class="text-danger">','</span>'); ?>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>