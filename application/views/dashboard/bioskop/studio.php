<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Content Row -->
    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger col-lg-4" role="alert">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="col-lg-6">
            <?= form_error('studio', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="addStudio btn btn-primary pull-right" data-toggle="modal" data-target="#studioModal">Add New Studio</a>
            <a href="<?= base_url('dashboard/bioskop/seat') ?>" class="badge badge-info pull-right p-2 ml-5">Seat Studio</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Information</th>
                            <th class="text-center">Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($tbl_studio as $studio) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $studio['name']; ?></td>
                                <td><?= $studio['information']; ?></td>
                                <td class="text-center">
                                    <?php if ($studio['is_active'] == '1') : ?>
                                        <input class="isActiveStudio" type="checkbox" value="<?= base_url('dashboard/bioskop/studioIsActive/'); ?>" name="is_active" for="is_avtive" data-id="<?= $studio['id']; ?>" data-ac="<?= $studio['is_active']; ?>" checked>
                                    <?php else : ?>
                                        <input class="isActiveStudio" type="checkbox" value="<?= base_url('dashboard/bioskop/studioIsActive/'); ?>" name="is_active" for="is_avtive" data-id="<?= $studio['id']; ?>" data-ac="<?= $studio['is_active']; ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#studioModal" class="editStudio badge badge-primary" data-id="<?= $studio['id']; ?>" data-name="<?= $studio['name']; ?>" data-inf="<?= $studio['information']; ?>">Edit</a>
                                    <a href="<?= base_url('dashboard/bioskop/deleteStudio/' . $studio['id']) ?>" class="deleteData badge badge-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
</div>
<!-- End of Main Content -->


<!-- Modal Studio -->
<div class="modal fade" id="studioModal" tabindex="-1" role="dialog" aria-labelledby="studioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studioModalLabel">Add New Studio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="studio" action="" method="post">
                    <input type="hidden" class="form-action" id="linkAddStudio" value="<?= base_url('dashboard/bioskop/studio') ?>">
                    <input type="hidden" class="form-action" id="linkEditStudio" value="<?= base_url('dashboard/bioskop/editStudio') ?>">
                    <div class="modal-body">
                        <!-- id -->
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <!-- name -->
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Studio">
                        </div>
                        <div class="form-group">
                            <!-- information -->
                            <input type="text" class="form-control" id="information" name="information" placeholder="Enter Information">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <!-- is active -->
                                <!-- <input type="hidden" id="is_active" value="1" name="is_active"> -->
                                <input class="studioIsActive" type="checkbox" id="is_active" value="" name="is_active" for="is_avtive" checked>
                                <label for="is_active" class="form-check-label"> Active? </label>
                            </div>
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