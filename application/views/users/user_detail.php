<?php
if ($this->session->flashdata('login_success')) {
    print '<div class= "success-msg">' . $this->session->flashdata('login_success') . '</div>';
}
if ($this->session->flashdata('success')) {
    print '<div class= "success-msg">' . $this->session->flashdata('success') . '</div>';
}
if ($this->session->flashdata('error')) {
    print '<div class= "error-msg">' . $this->session->flashdata('error') . '</div>';
}
?>


<div class="card card-body">
    <hr>
    <h3 style="text-align: center">Profile Detail</h3>
    <hr>
    <h4 class="text-info"><?= ($user_detail->name) . " " . ($user_detail->surname) ?></h4>
    <p><i class="fas fa-envelope"></i> <?= ($user_detail->email) ?></p>
    <p><i class="fas fa-mobile-alt"></i> <?= ($user_detail->contact) ?></p>
    <p><i class="fas fa-history"></i> Joined from: <?= (date('d-M, y', strtotime($user_detail->createdate))) ?></p>
</div>