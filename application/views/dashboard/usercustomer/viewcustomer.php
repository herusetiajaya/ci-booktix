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

    <div class="card mb-3" style="max-width: 640px;">
        <div class="row no-gutters">
            <div class="col-md-3 pl-3 pb-3 pt-4">
                <img src="<?= base_url('assets/frontend/img/profile/') . $tbl_customer['image']; ?>" class="card-img">
            </div>
            <div class="col-md-8 mt-3 ml-3">
                <div class="row">
                    <div class="card-body col-md-7">
                        <h4 class="card-text"><?= $tbl_customer['name']; ?></h4>
                        <h5 class="card-text"><?= $tbl_customer['username']; ?></h5>
                        <p class="card-text"><?= $tbl_customer['email']; ?></p>
                        <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $tbl_customer['date_created']); ?></small></p>
                    </div>
                    <div class="card-body col-md-5 border-left-dark h-50 bo">
                        <small>Card ID :</small>
                        <small class="card-text"><?= $tbl_customer['card_id']; ?></small>
                        </br>
                        <small>Phone :</small>
                        <small class="card-text"><?= $tbl_customer['phone']; ?></small>
                        </br>
                        <small>Address :</small></br>
                        <small class="card-text"><?= $tbl_customer['address']; ?></small>
                    </div>
                </div>
                <div class="col-md- mb-3 ml-2">
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->