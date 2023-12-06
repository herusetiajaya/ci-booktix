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
                <img src="<?= base_url('assets/dashboard/img/profile/') . $useradmin['image']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $useradmin['name']; ?></h5>
                    <p class="card-text"><?= $useradmin['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $useradmin['date_created']); ?></small></p>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="<?= base_url('dashboard/user/editadmin/' . $useradmin['id']) ?>" class="badge badge-success">Edit Profile</a>
                        <a href="<?= base_url('dashboard/user/listadmin') ?>" class="badge badge-primary">Back</a>
                        <!-- <a href="<?= base_url('dashboard/user/changePasswordAdmin/') ?>" class="badge badge-info">Change Password</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->