<div class="clearfix">
    <div class="section-title">
        <h3 class="card-title">Order Detail</h3>
    </div>

    <table class="table">
        <tr>
            <th class="text-left">Name</th>
            <td class="text-left"><?= strip_tags($orderDetail->ship_name) ?></td>
        </tr>
        <tr>
            <th class="text-left">Surname</th>
            <td class="text-left"><?= strip_tags($orderDetail->ship_surname) ?></td>
        </tr>
        <tr>
            <th class="text-left">Email</th>
            <td class="text-left"><?= strip_tags($orderDetail->email) ?></td>
        </tr>
        <tr>
            <th class="text-left">Address</th>
            <td class="text-left"><?= strip_tags($orderDetail->address) ?></td>
        </tr>
        <tr>
            <th class="text-left">City</th>
            <td class="text-left"><?= strip_tags($orderDetail->city) ?></td>
        </tr>
        <tr>
            <th class="text-left">Total Price</th>
            <td class="text-left"><?= strip_tags($orderDetail->total_price) ?></td>
        </tr>
        <tr>
            <?php
            if ($orderDetail->paymentcheck == 1) {
                $orderDetail->paymentcheck = "Cash on delivery";
            } else {
                $orderDetail->paymentcheck = "Bank payment";
            }
            print '<th>Payment Type</th>';
            print '<td colspan="1">' . strip_tags($orderDetail->paymentcheck) . '</td>';
            ?>
        </tr>
        <tr>
            <th class="text-left">Order Date</th>
            <td colspan="1"><?= date('h:i a, d-M y', strtotime($orderDetail->dateTime)) ?></td>
        </tr>
    </table>

    <div class="section-title">
        <h3 class="card-title">Order Item List</h3>
    </div>

    <div class="box-element">
        <div class="cart-row">
            <div style="flex:1"></div>
            <div style="flex:2"><strong>Product Name</strong></div>
            <div style="flex:1"><strong>Price</strong></div>
            <div style="flex:1"><strong>Quantity</strong></div>
            <div style="flex:1"><strong>Total</strong></div>

        </div>

        <?php foreach ($orderItems as $orderItem): ?>
        <div class="cart-row">
            <div style="flex:1"><a href="<?= base_url('users/bookDetail/') . $orderItem->id ?>">
                    <img class="row-image" src="<?= $orderItem->book_image ?>">

                </a></div>
            <div style="flex:2">
                <p><?= $orderItem->book_name ?></p>
            </div>
            <div style="flex:1">
                <p><?= $orderItem->price ?> TL</p>
            </div>
            <div style="flex:1">
                <p class="quantity"><?= $orderItem->quantity ?></p>
            </div>
            <div style="flex:1">
                <p><?= $orderItem->total_price ?> TL</p>
            </div>

        </div>
        <?php endforeach; ?>

    </div>

</div>