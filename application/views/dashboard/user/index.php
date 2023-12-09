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

    <div class="card mb-3" style="max-width: 610px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/dashboard/img/profile/') . $user['image']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <a href="<?= base_url('dashboard/user/edit/') ?>" class="badge badge-success">Edit Profile</a>
                        <a href="<?= base_url('dashboard/user/changePassword/') ?>" class="badge badge-info">Change Password</a>
                        <a href="<?= base_url('dashboard/admin/') ?>" class="badge badge-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->