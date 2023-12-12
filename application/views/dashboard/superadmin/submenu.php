<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger col-lg-4" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="addSubMenuModal btn btn-primary mb-3" data-toggle="modal" data-target="#subMenuModal">Add New Submenu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <!-- <th scope="col">Active</th> -->
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <!-- <td style="text-align:center;">
                                <?php if ($sm['is_active'] == '1') : ?>
                                    <input class="form-check-input" type="checkbox" value="<?= $sm['is_active'] ?>" name="is_active" for="is_avtive" checked disabled>
                                <?php else : ?>
                                    <input class="form-check-input" type="checkbox" value="<?= $sm['is_active'] ?>" name="is_active" for="is_avtive">
                                <?php endif; ?>
                            </td> -->
                            <?php if ($sm['id'] == 1 or $sm['id'] == 2 or $sm['id'] == 3 or $sm['id'] == 4 or $sm['id'] == 5 or $sm['id'] == 6 or $sm['id'] == 7) : ?>
                                <td>
                                    <a href="" class="editSubMenuModal badge badge-success" data-toggle="modal" data-target="#subMenuModal" data-id="<?= $sm['id'] ?>" data-title="<?= $sm['title'] ?>" data-menu_id="<?= $sm['menu_id'] ?>" data-url="<?= $sm['url'] ?>" data-icon="<?= $sm['icon'] ?>" data-isActive="<?= $sm['is_active'] ?>" onclick="return false;" style="cursor:not-allowed; opacity:0.5; text-decoration:none;">edit</a>
                                    <a href="<?= base_url('dashboard/superadmin/deletesubmenu/' . $sm['id']); ?>" class="deleteData badge badge-danger" onclick="return false;" style="cursor:not-allowed; opacity:0.5; text-decoration:none;">delete</a>
                                </td>
                            <?php else : ?>
                                <td>
                                    <a href="" class="editSubMenuModal badge badge-success" data-toggle="modal" data-target="#subMenuModal" data-id="<?= $sm['id'] ?>" data-title="<?= $sm['title'] ?>" data-menu_id="<?= $sm['menu_id'] ?>" data-url="<?= $sm['url'] ?>" data-icon="<?= $sm['icon'] ?>" data-isActive="<?= $sm['is_active'] ?>">edit</a>
                                    <a href="<?= base_url('dashboard/superadmin/deletesubmenu/' . $sm['id']); ?>" class="deleteData badge badge-danger">delete</a>
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

<!-- Modal Sub Menu -->
<div class="modal fade" id="subMenuModal" tabindex="-1" role="dialog" aria-labelledby="sMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('dashboard/superadmin/submenu'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="defaultSelect">Select menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="hidden" id="is_active" value="1" name="is_active">
                                <input class="form-check-input" type="checkbox" id="is_active" value="1" name="is_active" for="is_avtive" checked disabled>
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