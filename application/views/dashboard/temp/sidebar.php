<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <?php if ($user['role_id'] == 1) : ?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard/superadmin'); ?>">
        <?php elseif ($user['role_id'] == 2) : ?>
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard/admin'); ?>">
            <?php endif; ?>
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-leaf"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Booktix</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- QUERY MENU -->
            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = queryMenuLevel($role_id);
            $menu = $this->db->query($queryMenu)->result_array();
            ?>
            <!-- LOOPING MENU -->
            <?php foreach ($menu as $m) : ?>

                <!-- JIKA MENU ADALAH SUPERADMIN -->
                <?php if ($m['menu'] === 'SuperAdmin') : ?>
                    <li class="nav-item <?= ($menuActive === $m['menu']) ? 'active' : '' ?>">
                        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-house-user"></i>
                            <span><?= $m['menu']; ?></span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-info py-2 collapse-inner rounded">
                                <!-- SUB-MENU SESUAI SUPERADMIN -->
                                <?php
                                $menuId = $m['id'];
                                $querySubMenu = querySubMenuLevel($menuId);
                                $subMenu = $this->db->query($querySubMenu)->result_array();
                                ?>
                                <?php foreach ($subMenu as $sm => $sf) : ?>
                                    <?php if ($m['menu'] === 'SuperAdmin') : ?>
                                        <a class="collapse-item" href="<?= base_url($sf['url']); ?>"><i class="<?= $sf['icon']; ?>"></i> <?= $sf['title']; ?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                    <hr class="sidebar-divider">

                <?php else : ?>
                    <!-- ELSE MENU ADALAH ADMIN -->
                    <div class="sidebar-heading">
                        <?= $m['menu']; ?>
                    </div>

                    <!-- SUB-MENU SESUAI ADMIN -->
                    <?php
                    $menuId = $m['id'];
                    $querySubMenu = querySubMenuLevel($menuId);
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <!-- Nav Item - Dashboard -->
                        <?php if ($title == $sm['title']) : ?>
                            <li class="nav-item active">
                            <?php else : ?>
                            <li class="nav-item">
                            <?php endif; ?>
                            <!-- Jika login level admin dan submenu listUserAdmin -->
                            <?php if ($user['role_id'] === '2' and $sm['id'] === '6') : ?>
                                <!-- <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>" onclick="return false;" style="cursor:not-allowed; opacity:0.5; text-decoration:none;">
                                    <i class="<?= $sm['icon']; ?>"></i>
                                    <span><?= $sm['title']; ?></span>
                                </a> -->
                            <?php else : ?>
                                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                                    <i class="<?= $sm['icon']; ?>"></i>
                                    <span><?= $sm['title']; ?></span>
                                </a>
                            <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                        <!-- Divider -->
                        <hr class="sidebar-divider">
                    <?php endif; ?>
                <?php endforeach; ?>

                <!-- Nav Item - Logout -->
                <li class="nav-item submit-logout">
                    <a class="nav-link" href="<?= base_url('dashboard/auth/logout'); ?>">
                        <i class=" fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

</ul>
<!-- End of Sidebar -->