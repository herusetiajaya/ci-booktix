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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('dashboard/user/addCustomer') ?>" class="btn btn-primary pull-right">
                Add Customer
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Name</th>
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
                        foreach ($listcustomer as $listC) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $listC['username']; ?></td>
                                <td><?= $listC['email']; ?></td>
                                <td><?= $listC['name']; ?></td>
                                <td width="50px"><img class="img-thumbnail" src="<?= base_url('assets/frontend/img/profile/') . $listC['image']; ?>"></td>
                                <!-- <td><?= $listC['card_id']; ?></td> -->
                                <!-- <td><?= $listC['phone']; ?></td> -->
                                <!-- <td><?= $listC['address']; ?></td> -->
                                <td style="text-align:center;">
                                    <?php if ($listC['is_active'] == '1') : ?>
                                        <input class="form-check-input" type="checkbox" value="<?= $listC['is_active'] ?>" name="is_active" for="is_avtive" checked>
                                    <?php else : ?>
                                        <input class="form-check-input" type="checkbox" value="<?= $listC['is_active'] ?>" name="is_active" for="is_avtive">
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d F Y', $listC['date_created']); ?></td>
                                <td><a href="<?= base_url('dashboard/user/viewUserCustomer') ?>" class="badge badge-primary">View</a></td>
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