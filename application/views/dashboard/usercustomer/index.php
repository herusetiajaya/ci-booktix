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
            <a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#customerModal">
                Add User Customer
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
                            <!-- <th>Card ID</th> -->
                            <!-- <th>Phone</th> -->
                            <!-- <th>Address</th> -->
                            <th>Active</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($tbl_customer as $customer) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $customer['username']; ?></td>
                                <td><?= $customer['email']; ?></td>
                                <td><?= $customer['name']; ?></td>
                                <td width="50px"><img class="img-thumbnail" src="<?= base_url('assets/frontend/img/profile/') . $customer['image']; ?>"></td>
                                <!-- <td><?= $customer['card_id']; ?></td> -->
                                <!-- <td><?= $customer['phone']; ?></td> -->
                                <!-- <td><?= $customer['address']; ?></td> -->
                                <td style="text-align:center;">
                                    <?php if ($customer['is_active'] == '1') : ?>
                                        <input class="isActiveCustomer" type="checkbox" value="<?= $customer['is_active'] ?>" name="is_active" for="is_avtive" data-id="<?= $customer['id']; ?>" data-ac="<?= $customer['is_active']; ?>" checked>
                                    <?php else : ?>
                                        <input class="isActiveCustomer" type="checkbox" value="<?= $customer['is_active'] ?>" name="is_active" for="is_avtive" data-id="<?= $customer['id']; ?>" data-ac="<?= $customer['is_active']; ?>">
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d F Y', $customer['date_created']); ?></td>
                                <td>
                                    <a href="<?= base_url('dashboard/usercustomer/viewUserCustomer/' . $customer['id']) ?>" class="badge badge-primary">View</a>
                                    <a href="<?= base_url('dashboard/usercustomer/deleteCustomer/' . $customer['id']) ?>" class="deleteData badge badge-danger">Delete</a>
                                </td>
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

<!-- Modal List Customer -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="<?= base_url('dashboard/usercustomer/addCustomer'); ?>" method="post">
                    <div class="modal-body">
                        <!-- id -->
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <!-- username -->
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <!-- name -->
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter FullName">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <!-- email -->
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
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