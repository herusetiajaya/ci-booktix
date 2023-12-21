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
            <?= form_error('schedule', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="addSchedule btn btn-primary pull-right" data-toggle="modal" data-target="#scheduleModal">Add new Schedule</a>
            <a href="<?= base_url('dashboard/bioskop/time') ?>" class="badge badge-info pull-right p-2 ml-5">Time Schedule</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($tblSchedule as $schedule) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $schedule['date']; ?></td>
                                <td>
                                    <?= rupiah($schedule['price']) ?>
                                </td>
                                <td><?= $schedule['message']; ?></td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#scheduleModal" class="editSchedule badge badge-primary" data-id="<?= $schedule['id']; ?>">Edit</a>
                                    <a href="<?= base_url('dashboard/bioskop/deleteScheduleById/' . $schedule['id']) ?>" class="deleteData badge badge-danger">Delete</a>
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

<!-- Modal Schedule -->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="schedule" action="" method="post">
                    <div class="modal-body">
                        <!-- id -->
                        <input type="hidden" class="form-control" id="id" name="id">

                        <!-- datepicker -->
                        <div class="form-group">
                            <input type="text" class="form-control dateSchedule" name="date" id="date" placeholder="Date" readonly>
                            <div class="form-control-addon">
                                <!-- <span class="glyphicon glyphicon-calendar fas fa-calendar-alt h3 pl-2"></span> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- price -->
                            <input type="number" step="any" class="form-control" id="price" name="price" placeholder="Enter price">
                        </div>
                        <div class="form-group">
                            <!-- message -->
                            <input type="text" class="form-control" id="message" name="message" placeholder="Enter Message">
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

<input type="hidden" class="linkGetSchedule" value="<?= base_url('dashboard/bioskop/getSchedule/') ?>">
<input type="hidden" class="linkAdd" value="<?= base_url('dashboard/bioskop/schedule/') ?>">
<input type="hidden" class="linkEdit" value="<?= base_url('dashboard/bioskop/editSchedule/') ?>">