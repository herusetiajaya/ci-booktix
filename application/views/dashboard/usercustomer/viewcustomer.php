<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('user', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 680px;">
        <div class="row no-gutters">
            <div class="col-md-3 pl-2 pt-4">
                <img src="<?= base_url('assets/frontend/img/profile/') . $tbl_customer['image']; ?>" class="card-img">
            </div>
            <div class="col-md- mt-2">
                <div class="card-body">
                    <h4 class="card-text"><?= $tbl_customer['name']; ?></h4>
                    <h5 class="card-text"><?= $tbl_customer['email']; ?></h5>
                    <p class="card-text"><?= $tbl_customer['phone']; ?></p>
                    <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $tbl_customer['date_created']); ?></small></p>
                </div>
            </div>
            <div class="col-md- mt-3">
                <div class="card-body">
                    <h6 class="card-text">User Name</h6>
                    <h6 class="card-text">Card ID</h6>
                    <h6 class="card-text">Address</h6>
                </div>
            </div>
            <div class="col-md- mt-3">
                <div class="card-body">
                    <h6 class="card-text"><?= $tbl_customer['username']; ?></h6>
                    <h6 class="card-text"><?= $tbl_customer['card_id']; ?></h6>
                    <h6 class="card-text"><?= $tbl_customer['address']; ?></h6>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-md- p-3">
                <a href="<?= base_url('dashboard/usercustomer/editcustomer/' . $tbl_customer['id']) ?>" class="badge badge-success">Edit Profile</a>
                <a href="<?= base_url('dashboard/usercustomer/changepasswordcustomer/' . $tbl_customer['id']) ?>" class="badge badge-info">Change Password</a>
                <a href="<?= base_url('dashboard/usercustomer/resetpasswordcustomer/' . $tbl_customer['id']) ?>" class="badge badge-warning">Reset Password</a>
                <a href="<?= base_url('dashboard/usercustomer/') ?>" class="badge badge-primary">Back</a>
            </div>
        </div>
    </div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->