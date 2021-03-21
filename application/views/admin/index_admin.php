<div class="admin-index section-padding" style="min-height: 500px;">
    <div class="text-center">
        <h3>Admin Panel</h3>
        <h5>Welcome <?= $this->session->userdata('name') . $this->session->userdata('surname') ?></h5>
    </div>

    <div class="admin-content section-padding">
        <div class="container">
            <div class="row con-flex">
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="col-admin bg-primary clickable-div" data-href="<?= base_url('admin/allBooks') ?>">
                        <div>
                            <i class="fas fa-book"></i>
                            <h6>Total Books</h6>
                        </div>

                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="col-admin bg-success clickable-div" data-href="<?= base_url('admin/getCategories') ?>">
                        <div>
                            <i class="fas fa-list"></i>
                            <h6>Total Category</h6>
                        </div>

                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="col-admin bg-secondary clickable-div" data-href="<?= base_url('admin/getAllUser') ?>">
                        <div>
                            <i class="fas fa-users"></i>
                            <h6>Total Users</h6>
                        </div>


                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="col-admin bg-info clickable-div" data-href="<?= base_url('admin/allEBooks') ?>">
                        <div>
                            <i class="fas fa-desktop"></i>
                            <h6>Total e-books</h6>
                        </div>

                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="col-admin bg-danger clickable-div" data-href="">
                        <div>
                            <i class="fas fa-shopping-cart"></i>
                            <h6>Total orders</h6>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


</div>