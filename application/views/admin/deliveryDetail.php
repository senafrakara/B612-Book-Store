<?php
if ($this->session->flashdata('success')) {
    print '<div class= "success-msg">' . $this->session->flashdata('success') . '</div>';
}
?>

<div class="clearfix">
    <div class="section-title">
        <h3 class="card-title">Delivery Detail</h3>
    </div>

    <table class="table">
        <tr>
            <th class="text-left">Ship Name</th>
            <td class="text-left"><?= strip_tags($orderDetail->ship_name) ?></td>
        </tr>
        <tr>
            <th class="text-left">Ship Surname</th>
            <td class="text-left"><?= strip_tags($orderDetail->ship_surname) ?></td>
        </tr>
        <tr>
            <th class="text-left">Ship Email</th>
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
        <tr>
            <th class="text-left">Order Status</td>
            <td class="text-left">
                <?php
                if ($orderDetail->status == 1) {
                    $orderDetail->status = '<p class = "text-success">Accepted</p>';
                } else {
                    $orderDetail->status = '<p class = "text-danger">Pending</p>';
                }
                print  $orderDetail->status;

                ?>
            </td>
        </tr>
        <tr>
            <th class="text-left">Delivery Status</th>
            <td class="text-left">
                <?php
                if ($orderDetail->del_status == 1) {
                    $orderDetail->del_status = '<p class = "text-success">Delivered</p>';
                } else {
                    $orderDetail->del_status = '<p class = "text-danger">Waiting for Delivered</p>';
                }
                print  $orderDetail->del_status;

                ?>
            </td>
        </tr>
        <?php if ($orderDetail->userId) : ?>
            <tr>
                <th class="text-left">Order Placed By</th>
                <td>
                    <p><?= $orderDetail->usname ?> <?= $orderDetail->ussurname ?> / <?= $orderDetail->usemail ?></p>
                </td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="section-title">
        <h3 class="card-title">Order Items List</h3>
    </div>

    <div class="box-element">
        <div class="cart-row">
            <div style="flex:1"></div>
            <div style="flex:2"><strong>Product Name</strong></div>
            <div style="flex:1"><strong>Price</strong></div>
            <div style="flex:1"><strong>Quantity</strong></div>
            <div style="flex:1"><strong>Total</strong></div>

        </div>

        <?php foreach ($orderItems as $orderItem) : ?>
            <div class="cart-row">
                <div style="flex:1"><a href="<?= base_url('admin/bookDetail/') . $orderItem->id ?>">
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
    <a href="<?= base_url('admin/cancleDelivery/'.$orderDetail->orderId.'')?>" class="btn btn-danger btn-sm delete" data-confirm = "Are you sure to cancel this order delivery?">Cancel Delivery</a>

</div>