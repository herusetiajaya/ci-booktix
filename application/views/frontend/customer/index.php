<div class="container mt-3 mb-4">
    <div class="card-header bg-info">
        <h3 class="text text-white">My Profile</h3>
        <div class="row justify-content-center">

            <div class="col-lg-5">

                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                    </div>

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <div class="col-lg- d-flex justify-content-center">
                                    <?= form_error('customer', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    <?= $this->session->flashdata('message'); ?>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-md-5 pl-2 pt-4">
                                        <img src="<?= base_url('assets/frontend/img/profile/') . $user['image']; ?>" class="card-img">
                                        <div class="card-body">
                                            <small class="text-muted">Card ID :</small>
                                            <small class="text-muted"><?= $user['card_id']; ?></small>
                                            </br>
                                            <small class="text-muted">Phone :</small>
                                            <small class="text-muted"><?= $user['phone']; ?></small>
                                            </br>
                                            <small class="text-muted">Address :</small>
                                            <small class="text-muted"><?= $user['address']; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3 ml-3">
                                        <div class="row">
                                            <div class="card-body">
                                                <h4 class="card-text"><?= $user['name']; ?></h4>
                                                <h5 class="card-text"><?= $user['username']; ?></h5>
                                                <p class="card-text"><?= $user['email']; ?></p>
                                                <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $user['date_created']); ?></small></p>
                                            </div>
                                        </div>
                                        <div class="col-md- ml-1">
                                            <a href="<?= base_url('frontend/customer/edit') ?>" class="badge badge-success">Edit Profile</a>
                                            <a href="<?= base_url('frontend/customer/changePassword') ?>" class="badge badge-info">Change Password</a>
                                        </div>
                                        <div class="col-md- p-3 ml-5 mt-3">
                                            <a href="#" class="badge badge-warning">My Ticket</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>