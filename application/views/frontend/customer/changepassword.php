<!-- Begin Page Content -->
<div class="container mt-3 mb-4">
    <div class="card-header bg-info">
        <h3 class="text text-white"><?= $title; ?></h3>
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                    </div>
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg d-flex justify-content-center">
                            <div class="pt-4">
                                <div class="container-fluid">
                                    <!-- Page Heading -->
                                    <?= $this->session->flashdata('message'); ?>
                                    <form action="<?= base_url('frontend/customer/changePassword'); ?>" method="post">
                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <input type="text" class="form-control" id="current_password" name="current_password">
                                            <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password1">New Password</label>
                                            <input type="password" class="form-control" id="new_password1" name="new_password1">
                                            <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password2">Repeat Password</label>
                                            <input type="password" class="form-control" id="new_password2" name="new_password2">
                                            <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                            <a href="<?= base_url('frontend/customer') ?>"><button type="button" class="btn btn-danger">Cencel</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End of Main Content -->