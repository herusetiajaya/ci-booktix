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

    <div class="card mb-3" style="max-width: 620px;">
        <div class="row no-gutters">
            <div class="col-md-3 pl-2 pt-4">
                <img src="<?= base_url('assets/dashboard/img/profile/') . $useradmin['image']; ?>" class="card-img">
            </div>
            <div class="col-md-9">
                <div class="row">

                    <div class="col-md-6 card-body about-generic-area">
                        <h4 class="card-title"><?= $useradmin['name']; ?></h4>
                        <h5 class="card-title"><?= $useradmin['username']; ?></h5>
                        <p class="card-text"><?= $useradmin['email']; ?></p>
                        <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $useradmin['date_created']); ?></small></p>
                    </div>

                    <!-- Role/Level -->
                    <div class="card-body about-generic-area border-left-dark h-50">
                        <h6><small>Role / Level</small></h6>
                        <?php if ($useradmin['id'] == 1) : ?>
                            <h5><label for="role_id">SuperAdmin</label>
                                <input class="roleAdmin" type="checkbox" checked disabled name="role_id" for="role_id" data-id="<?= $useradmin['id']; ?>" data-r="<?= $useradmin['role_id']; ?>">
                            </h5>
                        <?php elseif ($useradmin['role_id'] == 1) : ?>
                            <h5><label for="role_id">SuperAdmin</label>
                                <input class="roleAdmin" type="checkbox" checked name="role_id" for="role_id" data-id="<?= $useradmin['id']; ?>" data-r="<?= $useradmin['role_id']; ?>">
                            </h5>
                        <?php elseif ($useradmin['role_id'] == 2) : ?>
                            <h5><label for="role_id">SuperAdmin</label>
                                <input class="roleAdmin" type="checkbox" name="role_id" for="role_id" data-id="<?= $useradmin['id']; ?>" data-r="<?= $useradmin['role_id']; ?>">
                            </h5>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="col-md- ml-2 about-generic-area">
                    <a href="<?= base_url('dashboard/user/editadmin/' . $useradmin['id']) ?>" class="badge badge-success">Edit Profile</a>
                    <a href="<?= base_url('dashboard/user/changePasswordAdmin/' . $useradmin['id']) ?>" class="badge badge-info">Change Password</a>
                    <a href="<?= base_url('dashboard/user/resetpasswordadmin/' . $useradmin['id']) ?>" class="badge badge-warning">Reset Password</a>
                    <a href="<?= base_url('dashboard/user/listadmin') ?>" class="badge badge-primary">Back</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->