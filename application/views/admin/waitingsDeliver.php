<br>
<?php
if ($this->session->flashdata('success')) {
    print '<div class= "success-msg">' . $this->session->flashdata('success') . '</div>';
}
?>
<div class="section-padding">
    <h6><a href="<?= base_url('admin/allDeliveredOrders') ?>" class="text-primary"><i class="fas fa-truck"></i> Delivered Orders</a></h6>
</div>


<div class="clearfix">
    <div class="section-title">
        <h3 class="card-title">Orders Waitings For Delivered</h3>
    </div>

    <table class="table">

        <thead>
            <tr>
                <th class="text-left">Ship Name</th>
                <th class="text-left">Ship Surname</th>
                <th class="text-left">Ship Email</th>
                <th class="text-left">Contact</th>
                <th class="text-left">Total</th>
                <th class="text-left">Date</th>
                <th scope="text-left">Delivery Status</th>
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
                        if ($order->del_status == 1) {
                            $order->del_status = '<span class = "text-success">Delivered</span>';
                        } else {
                            $order->del_status = '<span class = "text-danger">Set to deliver</span>';
                        }
                        print $order->del_status ;

                        ?></td>
                    <?php print '<td>';
                    print '<a href= "' . base_url() . 'admin/confirmDelivery/' . $order->orderId . '" title= "Delivered" class="btn btn-success btn-sm confirm-alert" data-confirm = "Are you sure to confirm this order delivery.?">Set To Delivered</a>&nbsp';
                    print '<a href= "' . base_url() . 'admin/deliveryDetail/' . $order->orderId . '" title= "View Details" class="btn btn-primary btn-sm">Details</a>&nbsp';
                    print '</td>';
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>