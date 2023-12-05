<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="addModalMenu btn btn-primary mb-3" data-toggle="modal" data-target="#menuModal">Add New Menu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $m['menu']; ?></td>

                            <?php if ($m['id'] === '1' or $m['id'] === '2' or $m['id'] === '3') : ?>
                                <td>
                                    <a href="" class="editModalMenu badge badge-success" data-toggle="modal" data-target="#menuModal" data-id="<?= $m['id']; ?>" data-menu="<?= $m['menu']; ?>" onclick="return false;" style="cursor:not-allowed; opacity:0.5; text-decoration:none;">edit</a>
                                    <a href="<?= base_url('dashboard/superadmin/deletemenu/' . $m['id']); ?>" class="deleteData badge badge-danger" onclick="return false;" style="cursor:not-allowed; opacity:0.5; text-decoration:none;">delete</a>
                                </td>
                            <?php else : ?>
                                <td>
                                    <a href="" class="editModalMenu badge badge-success" data-toggle="modal" data-target="#menuModal" data-id="<?= $m['id']; ?>" data-menu="<?= $m['menu']; ?>">edit</a>
                                    <a href="<?= base_url('dashboard/superadmin/deletemenu/' . $m['id']); ?>" class="deleteData badge badge-danger">delete</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal MENU -->
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('dashboard/superadmin/menu'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
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