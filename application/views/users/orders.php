<br>


<div class="clearfix">
    <div class="section-title">
        <h3 class="card-title">Order List</h3>
    </div>

    <table class="table">

        <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Surname</th>
                <th class="text-left">Email</th>
                <th class="text-left">Contact</th>
                <th class="text-left">Total</th>
                <th class="text-left">Date</th>
                <th scope="text-left">Orders Status</th>
                <th scope="text-left">Action</th>

            </tr>
        </thead>

        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td class="text-left"><?= substr(strip_tags($order->ship_name), 0, 100) ?></td>
                    <td class="text-left"> <?= substr(strip_tags($order->ship_surname), 0, 100) ?></td>
                    <td class="text-left"><?= strip_tags($order->email) ?></td>
                    <td class="text-left"><?= strip_tags($order->contact) ?></td>
                    <td class="text-left"><?= strip_tags($order->total_price) ?> TL</td>
                    <td class="text-left"><?= date('h:i a, d-M y', strtotime($order->dateTime)) ?></td>
                    <td class="text-left">
                        <?php
                        if ($order->status == 1) {
                            $order->status = '<span class = "text-success">Accepted</span>';
                        } else {
                            $order->status = '<span class = "text-danger">Pending</span>';
                        }
                        print  $order->status ;

                        ?></td>
                    <td class="text-left"><a class="btn btn-outline-primary waves-effect waves-light" href="<?= base_url('user_account/orderDetail/') . $order->orderId ?>">Detail</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>