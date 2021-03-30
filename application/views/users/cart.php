<?php
if ($this->session->flashdata('cart_error')) {
    print '<div class = "error-msg">' . $this->session->flashdata('cart_error') . '</div>';
}

if ($this->session->flashdata('remove_cart')) {
    print '<div class = "error-msg">' . $this->session->flashdata('remove_cart') . '</div>';
}
if ($this->session->flashdata('not_enough')) {
    print '<div class = "error-msg">' . $this->session->flashdata('not_enough') . '</div>';
}
?>
<?php $totalPrice = 0;
$isAnyProduct = TRUE;
?>

<div class="row">
    <div class="col-lg-12">

        <br>

        <?php if ($this->cart->contents()) : ?>

            <div class="box-element">
                <div class="cart-row">
                    <div style="flex:1"></div>
                    <div style="flex:2"><strong>Item</strong></div>
                    <div style="flex:1"><strong>Price</strong></div>
                    <div style="flex:1"><strong>Quantity</strong></div>
                    <div style="flex:1"><strong>Total</strong></div>
                    <div style="flex:1"><strong>Delete</strong></div>
                </div>
                <?php
                $i = 1;
                foreach ($this->cart->contents() as $book) : ?>

                    <div class="cart-row">
                        <div style="flex:1"><img class="row-image" src="<?= $book['book_image'] ?>"></div>
                        <div style="flex:2">
                            <p><?= $book['name'] ?></p>
                        </div>

                        <div style="flex:1" class="product-price float-left" id="product-price-<?= $book['rowid'] ?>">
                            <?=$book['price']  ?> TL
                        </div>
                      
                        <div style="flex:1">
                            <div class="quantity">
                                <img onclick="increment_quantity2(<?= $book['rowid']?>)" data-rowid="<?= $book['rowid'] ?>"  data-qty="<?= $book['qty'] ?>" class="chg-quantity update-cart" src="<?= base_url() . "style/img/arrow-up.png" ?>">
                                <input class="input-quantity quantity" id="input-quantity-<?= $book['rowid'] ?>" value="<?= $book['qty']  ?>">
                                <img onclick="decrement_quantity2(<?= $book['rowid'] ?>)"  data-rowid="<?= $book['rowid'] ?>"  data-qty="<?= $book['qty']?>" class="chg-quantity update-cart" src="<?= base_url() . "style/img/arrow-down.png" ?>">
                            </div>
                        </div>
               
                        <div style="flex:1" class="cart-info price" id="cart-price-<?= $book['rowid'] ?>">
                            <?=  $book['subtotal'] ?> TL
                        </div>

                        <div style="flex:1">
                            <?php print anchor("cart/deleteItem/" . $book['rowid'] . "", "<i class = 'fas fa-trash'></i>", ['class' => 'btn btn-outline-danger btn-sm', 'title' => 'Delete']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>

        <?php elseif ($this->session->userdata('id') && $cartItems) : ?>

            <div class="box-element">
                <div class="cart-row">
                    <div style="flex:1"></div>
                    <div style="flex:2"><strong>Item</strong></div>
                    <div style="flex:1"><strong>Price</strong></div>
                    <div style="flex:1"><strong>Quantity</strong></div>
                    <div style="flex:1"><strong>Total</strong></div>
                    <div style="flex:1"><strong>Delete</strong></div>
                </div>
                <?php
                $i = 1;

                foreach ($cartItems as $book) : ?>
                    <?php $totalPrice += ($book->price * $book->qty); ?>
                    <div class="cart-row">
                        <div style="flex:1"><img class="row-image" src="<?= $book->book_image ?>"></div>
                        <div style="flex:2">
                            <p><?= $book->book_name ?></p>
                        </div>

                        <div style="flex:1" class="product-price float-left" id="product-price-<?= $book->cartItemID ?>">
                            <?= $book->price ?> TL
                        </div>

                        <div style="flex:1">
                            <div class="quantity">
                                <img onclick="increment_quantity(<?= $book->cartItemID ?>)" class="chg-quantity update-cart" src="<?= base_url() . "style/img/arrow-up.png" ?>">
                                <input class="input-quantity quantity" id="input-quantity-<?= $book->cartItemID ?>" value="<?= $book->qty  ?>">
                                <img onclick="decrement_quantity(<?= $book->cartItemID ?>)" class="chg-quantity update-cart" src="<?= base_url() . "style/img/arrow-down.png" ?>">
                            </div>
                        </div>

                        <div style="flex:1" class="cart-info price" id="cart-price-<?= $book->cartItemID ?>">
                            <?= ($book->price * $book->qty) ?> TL
                        </div>

                        <div style="flex:1">
                            <?php print anchor("cart/deleteCartItem/" . $book->cartItemID . "", "<i class = 'fas fa-trash'></i>", ['class' => 'btn btn-outline-danger btn-sm', 'title' => 'Delete']); ?>
                        </div>
                    </div>
                    <br>

                <?php endforeach; ?>

            </div>

        <?php else : ?>
            <?php
            $isAnyProduct = FALSE;
            $this->load->view('include/404cart') ?>
        <?php endif; ?>
        <?php if ($isAnyProduct) : ?>
            <div class="cart-row" style="border-radius: 4px;padding: 10px;">
                <div style="flex:3">
                    <a class="btn btn-outline-dark" href="<?= base_url('users/allBooks') ?>">&#x2190; Continue Shopping</a>

                </div>
                <div style="flex:1; text-align:right;">
                    <h4 id="total-price" style="font-weight: 600;">
                        <?php
                        if ($this->cart->contents()) {

                            print $this->cart->total();
                        } elseif ($this->session->userdata('id') && $cartItems) {
                            print $totalPrice;
                        } else {
                            print "0";
                        }
                        ?>
                         TL
                    </h4>

                </div>
                <div style="flex:1">
                    <h5> <a style="float:right; margin:5px;" class="btn btn-success" href="<?= base_url('checkout'); ?>">Checkout</a>
                    </h5>

                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- <script>
                    function increaseItem(item_id) {
                        $.ajax({
                            url: '='+item_id,
                            success: function(output) {

                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    }

                    function decreaseItem(item_id) {

                    }
                </script> -->