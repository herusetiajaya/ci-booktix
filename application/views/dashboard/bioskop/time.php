<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Time Schedule</h1>

    <!-- Content Row -->
    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger col-lg-4" role="alert">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="addTime btn btn-primary pull-right" data-toggle="modal" data-target="#timeModal">Add New Time</a>
            <a href="<?= base_url('dashboard/bioskop/schedule') ?>" class="badge badge-info pull-right p-2 ml-5">back</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Time</th>
                            <th>Date Schedule</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($tblTime as $time) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $time['time']; ?></td>
                                <td><?= $time['date']; ?></td>
                                <td>
                                    <a href="" class="editTime badge badge-primary" data-toggle="modal" data-target="#timeModal" data-id="<?= $time['id']; ?>" data-t="<?= $time['time']; ?>" data-si="<?= $time['schedule_id']; ?>">Edit</a>
                                    <a href="<?= base_url('dashboard/bioskop/deleteTime/' . $time['id']) ?>" class="deleteData badge badge-danger">Delete</a>
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

<!-- Modal Time -->
<div class="modal fade" id="timeModal" tabindex="-1" role="dialog" aria-labelledby="timeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="timeModalLabel">Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="time" action="" method="post">
                    <input type="hidden" class="form-action" value="<?= base_url('dashboard/bioskop/time') ?>" id="linkAddTime">
                    <input type="hidden" class="form-action" value="<?= base_url('dashboard/bioskop/editTime') ?>" id="linkEditTime">
                    <div class="modal-body">
                        <!-- id -->
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <!-- timepicker -->
                            <div class="form-group">
                                <input type="text" class="form-control timeSchedule" name="time" id="time" placeholder="Time" readonly>
                                <span class="form-group-addon">
                                    <!-- <i class="glyphicon glyphicon-time fas fa-clock h3 pl-2"></i> -->
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Date Schedule -->
                            <label for="schedule_id">Select Date</label>
                            <div class="form-group">
                                <select name="schedule_id" id="schedule_id" class="form-control" required>
                                    <!-- <option value=" ">Select Date</option> -->
                                    <?php foreach ($tblSchedule as $schedule) : ?>
                                        <option value="<?= $schedule['id']; ?>"><?= $schedule['date']; ?></option>
                                    <?php endforeach; ?>
                                </select>
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