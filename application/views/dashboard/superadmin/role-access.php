<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?= $this->session->flashdata('message'); ?>

            <h5>Role : <?= $role['role']; ?></h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($menu as $m => $mf) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $mf['menu']; ?></td>

                            <td>
                                <?php if ($m === 0) : ?>
                                    <input type="checkbox" disabled class="form-check-input" <?= check_access($role['id'], $mf['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $mf['id']; ?>">
                                <?php elseif ($m > 0) : ?>
                                    <input type="checkbox" class="form-check-input" <?= check_access($role['id'], $mf['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $mf['id']; ?>">
                                <?php endif; ?>
                            </td>
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