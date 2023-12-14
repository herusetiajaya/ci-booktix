<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger col-lg-4" role="alert">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="col-lg-6">
            <?= form_error('user', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="addAdmin btn btn-primary pull-right" data-toggle="modal" data-target="#adminModal">
                Add User Admin
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th>Image</th>
                            <!-- <th>Password</th> -->
                            <th>Level</th>
                            <th>Active</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($tbl_admin as $adm) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $adm['username']; ?></td>
                                <td><?= $adm['email']; ?></td>
                                <td><?= $adm['name']; ?></td>
                                <td width="50px"><img class="img-thumbnail" src="<?= base_url('assets/dashboard/img/profile/') . $adm['image']; ?>"></td>
                                <!-- <td><?= $adm['password']; ?></td> -->
                                <td><?php if ($adm['role_id'] == '1') { ?>
                                        SuperAdmin
                                    <?php } else { ?>
                                        Admin
                                    <?php } ?>
                                </td>
                                <?php if ($adm['id'] === '1') : ?>
                                    <td class=" text-center">
                                        <!-- IS USER ACTIVE -->
                                        <?php if ($adm['is_active'] === '1') : ?>
                                            <input class="isActiveAdmin" type="checkbox" name="is_active" for="is_avtive" checked disabled data-id="<?= $adm['id']; ?>" data-ac="<?= $adm['is_active']; ?>">
                                        <?php else : ?>
                                            <input class="isActiveAdmin" type="checkbox" name="is_active" for="is_avtive" data-id="<?= $adm['id']; ?>" data-ac="<?= $adm['is_active']; ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d F Y', $adm['date_created']); ?></td>
                                    <td>
                                        <a href="<?= base_url('dashboard/user/viewAdmin/' . $adm['id']) ?>" class="badge badge-primary">View</a>
                                        <a href="<?= base_url('dashboard/user/deleteAdmin/' . $adm['id']) ?>" class="deleteData badge badge-danger" onclick="return false;" style="cursor:not-allowed; opacity:0.5; text-decoration:none;">Delete</a>
                                    </td>
                                <?php else : ?>
                                    <td class=" text-center">
                                        <!-- IS USER ACTIVE -->
                                        <?php if ($adm['is_active'] === '1') : ?>
                                            <input class="isActiveAdmin" type="checkbox" name="is_active" for="is_avtive" checked data-id="<?= $adm['id']; ?>" data-ac="<?= $adm['is_active']; ?>">
                                        <?php else : ?>
                                            <input class="isActiveAdmin" type="checkbox" name="is_active" for="is_avtive" data-id="<?= $adm['id']; ?>" data-ac="<?= $adm['is_active']; ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d F Y', $adm['date_created']); ?></td>
                                    <td>
                                        <a href="<?= base_url('dashboard/user/viewAdmin/' . $adm['id']) ?>" class="badge badge-primary">View</a>
                                        <a href="<?= base_url('dashboard/user/deleteAdmin/' . $adm['id']) ?>" class="deleteData badge badge-danger">Delete</a>
                                    </td>
                                <?php endif; ?>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal List Admin -->
<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminModalLabel">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="<?= base_url('dashboard/user/addadmin'); ?>" method="post">
                    <div class="modal-body">
                        <!-- id -->
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <!-- username -->
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <!-- name -->
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter FullName">
                        </div>
                        <div class="form-group">
                            <!-- email -->
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <!-- password -->
                            <input type="password" class="form-control" id="passwordFirst" name="passwordFirst" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <!-- Repeat password -->
                            <input type="password" class="form-control" id="passwordSecond" name="passwordSecond" placeholder="Repeat Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>