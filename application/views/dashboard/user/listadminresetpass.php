<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <label class="mb-3" for="current_password">Username : <?= $useradmin['username']; ?></label>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form class="user" method="post" action="<?= base_url('dashboard/user/resetPasswordAdmin/' . $useradmin['id']); ?>">
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" aria-describedby="emailHelp" placeholder="Enter new password...">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" aria-describedby="emailHelp" placeholder="Repeat password...">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary btn-user">
                    Reset Password
                </button>
                <a href="<?= base_url('dashboard/user/viewadmin/' . $useradmin['id']) ?>"><button type="button" class="btn btn-danger btn-user">Cencel</button></a>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->