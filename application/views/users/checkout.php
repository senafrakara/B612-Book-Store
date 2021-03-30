<?php
if ($this->session->flashdata('success')) {
    print '<div class= "success-msg">' . $this->session->flashdata('success') . '</div>';
}

?>
<?php

if ($isAnyProduct || $this->cart->contents()) :
?>
    <br>
    <?php $totalPrice = 0; ?>
    <div class="row">
        <div class="col-lg-6">
            <div id="table-header">shipping details</div>
            <?= form_open('checkout') ?>
            <div class="form-group">
                <?= form_input(['name' => 'name', 'placeholder' => 'Name', 'value' => set_value('name'), 'class' => 'form-control']) ?>
                <div class="text-danger form-error"><?= form_error('name') ?></div>
            </div>
            <div class="form-group">
                <?= form_input(['name' => 'surname', 'placeholder' => 'Surname', 'value' => set_value('surname'), 'class' => 'form-control']) ?>
                <div class="text-danger form-error"><?= form_error('surname') ?></div>
            </div>
            <div class="form-group">
                <?= form_input(['name' => 'email', 'placeholder' => 'Email...', 'value' => set_value('email'), 'class' => 'form-control']) ?>
                <div class="text-danger form-error"><?= form_error('email') ?></div>
            </div>
            <div class="form-group">
                <?= form_input(['name' => 'contact', 'placeholder' => 'Phone number', 'value' => set_value('contact'), 'class' => 'form-control']) ?>
                <div class="text-danger form-error"><?= form_error('contact') ?></div>
            </div>
            <div class="form-group">
                <?= form_textarea(['name' => 'address', 'placeholder' => 'Address',  'value' => set_value('address'), 'class' => 'form-control', 'rows' => '5']) ?>
                <div class="text-danger form-error"><?= form_error('address') ?></div>
            </div>
            <div class="form-group">
                <?= form_input(['name' => 'zipcode', 'placeholder' => 'Zip code', 'value' => set_value('zipcode'), 'class' => 'form-control']) ?>
                <div class="text-danger form-error"><?= form_error('zipcode') ?></div>
            </div>
            <div class="form-group">
                <?= form_input(['name' => 'city', 'placeholder' => 'City', 'value' => set_value('city'), 'class' => 'form-control']) ?>
                <div class="text-danger form-error"><?= form_error('city') ?></div>
            </div>

            <div id="table-header">Payments methods </div>
            <p>Now we have only option cash on delivery.Thanks for your supports</p>

            <div class="form-check">
                <?= form_checkbox(['name' => 'paymentcheck', 'class' => 'form-check-input', 'value' => TRUE]); ?>
                <label class="form-check-label" for="payment">
                    <b>Cash on delivery</b>
                </label>
                <div class="text-danger form-error"><?= form_error('paymentcheck') ?></div>
            </div>

            <br>

            <div class="sub">
                <span><?= form_submit(['name' => 'submit', 'value' => 'Place Order', 'class' => 'btn btn-primary my-btn']) ?></span>
            </div>
            <?= form_close() ?>
        </div>

        <div class="col-lg-6">
            <div class="box-element">
                <a class="btn btn-outline-dark" href="<?= base_url('cart') ?>">&#x2190; Back to Cart</a>
                <hr>
                <h3>Order Summary</h3>
                <hr>
                <?php if ($this->cart->contents()) : ?>
                    <?php foreach ($this->cart->contents() as $book) : ?>
                        <div class="cart-row">
                            <div style="flex:2"><img class="row-image" src="<?= $book['book_image'] ?>"></div>
                            <div style="flex:2">
                                <p><?= $book['name'] ?></p>
                            </div>
                            <div style="flex:1">
                                <p><?= $book['price'] ?> TL</p>
                            </div>
                            <div style="flex:1">
                                <p><?= $book['qty'] ?>x</p>
                            </div>
                        </div>

                    <?php endforeach; ?>
                    <?php $total = $this->cart->total(); ?>
                    <h5>Total: <?= $total ?> TL</h5>
                <?php else : ?>
                    <?php foreach ($cartItems as $book) : ?>
                        <?php $totalPrice += ($book->price * $book->qty); ?>
                        <div class="cart-row">
                            <div style="flex:2"><img class="row-image" src="<?= $book->book_image ?>"></div>
                            <div style="flex:2">
                                <p><?= $book->book_name ?></p>
                            </div>
                            <div style="flex:1">
                                <p><?= $book->price ?> TL</p>
                            </div>
                            <div style="flex:1">
                                <p><?= $book->qty ?>x</p>
                            </div>
                        </div>

                    <?php endforeach; ?>

                    <h5>Total: <?= $totalPrice ?> TL</h5>
                <?php endif; ?>


            </div>
        </div>
    </div>
<?php else :
    $this->load->view('include/404cart')
?>
<?php endif; ?>