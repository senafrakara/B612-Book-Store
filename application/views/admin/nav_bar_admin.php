<div class="admin-nav">
    <div class="user-name"><i class="fas fa-user"></i> <?php print $this->session->userdata('name') ?></div>
    <div class="admin-menu">
        <ul>
            <li><a href="<?= base_url()?>admin"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="<?= base_url()?>admin/getCategories"><i class="far fa-list-alt"></i> Category</a></li>
            <li><a href="<?= base_url()?>admin/allBooks"><i class="fas fa-book"></i> Books</a></li>
            <li><a href="<?= base_url()?>admin/getAllUser"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="<?= base_url()?>admin/allEBooks"><i class="fas fa-chalkboard-teacher"></i> E-books</a></li>
            <li><a href="<?= base_url()?>admin/allOrders"><i class="fas fa-cart-arrow-down"></i> Orders</a></li>

            <li><a href="<?= base_url()?>users/logout"><i class="fas fa-power-off"></i> Logout</a></li>
        </ul>
    </div>
</div>
