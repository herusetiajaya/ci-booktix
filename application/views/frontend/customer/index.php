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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?= form_error('customer', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                        <?= $this->session->flashdata('message'); ?>
                                    </div>
                                </div>

                                <div class="row no-gutters">
                                    <div class="col-md-5 p-3">
                                        <img src="<?= base_url('assets/frontend/img/profile/') . $user['image']; ?>" class="card-img">
                                    </div>
                                    <div class="col-md- mt-2">
                                        <div class="card-body">
                                            <h4 class="card-text"><?= $user['name']; ?></h4>
                                            <h5 class="card-text"><?= $user['email']; ?></h5>
                                            <p class="card-text"><?= $user['phone']; ?></p>
                                            <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $user['date_created']); ?></small></p>
                                        </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="card-body">
                                            <h6 class="card-text">User Name</h6>
                                            <h6 class="card-text">Card ID</h6>
                                            <h6 class="card-text">Address</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="card-body">
                                            <h6 class="card-text">:</h6>
                                            <h6 class="card-text">:</h6>
                                            <h6 class="card-text">:</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="card-body">
                                            <h6 class="card-text"><?= $user['username']; ?></h6>
                                            <h6 class="card-text"><?= $user['card_id']; ?></h6>
                                            <h6 class="card-text"><?= $user['address']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <a href="<?= base_url('dashboard/custu\omer/edit/') ?>" class="badge badge-success">Edit Profile</a>
                                            <a href="<?= base_url('dashboard/customer/changePassword/') ?>" class="badge badge-info">Change Password</a>
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