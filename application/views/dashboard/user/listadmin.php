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
            <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Image</th>
                            <!-- <th>Password</th> -->
                            <th>Level</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($listadmin as $listA) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $listA['name']; ?></td>
                                <td><?= $listA['email']; ?></td>
                                <td width="100px"><img class="img-thumbnail" src="<?= base_url('assets/dashboard/img/profile/') . $listA['image']; ?>"></td>
                                <!-- <td><?= $listA['password']; ?></td> -->
                                <td><?php if ($listA['role_id'] == '1') { ?>
                                        SuperAdmin
                                    <?php } else { ?>
                                        Admin
                                    <?php } ?>
                                </td>
                                <?php if ($listA['id'] === '1') : ?>
                                    <td style="text-align:center;">
                                        <!-- IS USER ACTIVE -->
                                        <?php if ($listA['is_active'] === '1') : ?>
                                            <input class="isActive form-check-input" type="checkbox" name="is_active" for="is_avtive" checked disabled data-id="<?= $listA['id']; ?>" data-ac="<?= $listA['is_active']; ?>">
                                        <?php else : ?>
                                            <input class="isActive form-check-input" type="checkbox" name="is_active" for="is_avtive" data-id="<?= $listA['id']; ?>" data-ac="<?= $listA['is_active']; ?>">
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('dashboard/user/viewAdmin/' . $listA['id']) ?>" class="badge badge-primary">View</a>
                                        <a href="<?= base_url('dashboard/user/deleteAdmin/' . $listA['id']) ?>" class="deleteData badge badge-danger" onclick="return false;" style="cursor:not-allowed; opacity:0.5; text-decoration:none;">Delete</a>
                                    </td>
                                <?php else : ?>
                                    <td style="text-align:center;">
                                        <!-- IS USER ACTIVE -->
                                        <?php if ($listA['is_active'] === '1') : ?>
                                            <input class="isActive form-check-input" type="checkbox" name="is_active" for="is_avtive" checked data-id="<?= $listA['id']; ?>" data-ac="<?= $listA['is_active']; ?>">
                                        <?php else : ?>
                                            <input class="isActive form-check-input" type="checkbox" name="is_active" for="is_avtive" data-id="<?= $listA['id']; ?>" data-ac="<?= $listA['is_active']; ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('dashboard/user/viewAdmin/' . $listA['id']) ?>" class="badge badge-primary">View</a>
                                        <a href="<?= base_url('dashboard/user/deleteAdmin/' . $listA['id']) ?>" class="deleteData badge badge-danger">Delete</a>
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
                <form action="<?= base_url('dashboard/user/test'); ?>" method="post">
                    <div class="modal-body">
                        <!-- id -->
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <!-- name -->
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
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
                            <!-- confirm password -->
                            <input type="password" class="form-control" id="passwordSecond" name="passwordSecond" placeholder="Confirm Password">
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