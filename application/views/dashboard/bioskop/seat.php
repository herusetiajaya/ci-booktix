<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Seat Studio</h1>

    <!-- Content Row -->
    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger col-lg-4" role="alert">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="col-lg-6">
            <?= form_error('seat', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="addSeat btn btn-primary pull-right" data-toggle="modal" data-target="#seatModal">Add New Seat</a>
            <a href="<?= base_url('dashboard/bioskop/studio') ?>" class="badge badge-info pull-right p-2 ml-5">back</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Seat</th>
                            <th>Studio Name</th>
                            <th>Ordered</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($tbl_seat as $seat) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $seat['code_seat']; ?></td>
                                <td><?= $seat['name']; ?></td>
                                <td class="text-center">
                                    <?php if ($seat['ordered'] == '1') : ?>
                                        <input class="orderedSeat" value="<?= base_url('dashboard/bioskop/orderedSeat/'); ?>" type="checkbox" data-id="<?= $seat['id']; ?>" data-ord="<?= $seat['ordered']; ?>" checked>
                                    <?php else : ?>
                                        <input class="orderedSeat" value="<?= base_url('dashboard/bioskop/orderedSeat/'); ?>" type="checkbox" data-id="<?= $seat['id']; ?>" data-ord="<?= $seat['ordered']; ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="" class="editSeat badge badge-primary" data-toggle="modal" data-target="#seatModal" data-id="<?= $seat['id']; ?>" data-cs="<?= $seat['code_seat']; ?>" data-sd="<?= $seat['studio_id']; ?>">Edit</a>
                                    <a href="<?= base_url('dashboard/bioskop/deleteSeat/' . $seat['id']) ?>" class="deleteData badge badge-danger">Delete</a>
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
<!-- /.container-fluid -->

<!-- Modal Seat -->
<div class="modal fade" id="seatModal" tabindex="-1" role="dialog" aria-labelledby="seatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seatModalLabel">Add New Seat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="seat" action="" method="post">
                    <input type="hidden" class="form-action" value="<?= base_url('dashboard/bioskop/seat') ?>" id="linkAddSeat">
                    <input type="hidden" class="form-action" value="<?= base_url('dashboard/bioskop/editSeat') ?>" id="linkEditSeat">
                    <div class="modal-body">
                        <!-- id -->
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <!-- code seat -->
                            <input type="text" class="form-control" id="code_seat" name="code_seat" placeholder="Enter Code Seat">
                        </div>
                        <div class="form-group">
                            <!-- Name Studio -->
                            <label for="studio_id">Select Studio</label>
                            <select name="studio_id" id="studio_id" class="form-control" required>
                                <?php foreach ($tbl_studio as $studio) : ?>
                                    <?php if ($studio['is_active'] == 1) : ?>
                                        <option value="<?= $studio['id']; ?>"><?= $studio['name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
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