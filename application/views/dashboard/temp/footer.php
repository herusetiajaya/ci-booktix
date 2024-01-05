<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Heru Setiawan <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>dashboard/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Custom scripts for all pages-->
<!-- <script src="<?= base_url('assets/'); ?>dashboard/js/jquery-3.7.0.min.js"></script> -->
<script src="<?= base_url('assets/'); ?>dashboard/js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/js/demo/datatables-demo.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/datepicker-1.9.0/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/timepicker-2.0.2/dist/mdtimepicker.js"></script>
<!-- Custom myscripts -->
<script src="<?= base_url('assets/'); ?>dashboard/js/owner/booktix-main.js"></script>
<script>
    // Change Access Role Menu
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('dashboard/superadmin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('dashboard/superadmin/roleaccess/'); ?>" + roleId;
            }
        });
    });
    // Modal Menu add
    $(document).on('click', '.addModalMenu', function() {
        $('#menuModalLabel').html('Add New Menu');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', "<?= base_url('dashboard/superadmin/menu'); ?>");
        $('.modal-body #id').val('');
        $('.modal-body #menu').val('');
    });
    // Modal Menu edit
    $(document).on('click', '.editModalMenu', function() {
        $('#menuModalLabel').html('Edit Name Menu');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', "<?= base_url('dashboard/superadmin/editmenu'); ?>");

        const menuId = $(this).data('id');
        const menuName = $(this).data('menu');
        $('.modal-body #id').val(menuId);
        $('.modal-body #menu').val(menuName);
    });
    // Modal Sub menu add
    $(document).on('click', '.addSubMenuModal', function() {
        $('#subMenuModalLabel').html('Add New Sub Menu');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', "<?= base_url('dashboard/superadmin/submenu'); ?>");
        $('.modal-body #title').val('');
        $('.modal-body #menu_id').val('defaultSelect');
        $('.modal-body #url').val('');
        $('.modal-body #icon').val('');
        document.getElementsByClassName('form-check')[0].style.visibility = 'initial';
    });
    // Modal Sub menu edit
    $(document).on('click', '.editSubMenuModal', function() {
        $('#subMenuModalLabel').html('Edit Sub Menu');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', "<?= base_url('dashboard/superadmin/editsubmenu'); ?>");
        const subMenuId = $(this).data('id');
        const title = $(this).data('title');
        const menuId = $(this).data('menu_id');
        const urlSubMenu = $(this).data('url');
        const icon = $(this).data('icon');
        $('.modal-body #id').val(subMenuId);
        $('.modal-body #title').val(title);
        $('.modal-body #menu_id').val(menuId);
        $('.modal-body #url').val(urlSubMenu);
        $('.modal-body #icon').val(icon);
        document.getElementsByClassName('form-check')[0].style.visibility = 'hidden';
    });
</script>
<script>
    // Change Sub Menu Is Active
    $('.subMenuIsActive').on('click', function() {
        const id = $(this).data('id');
        const isAct = $(this).data('ac');
        $.ajax({
            success: function() {
                // alert('success');
                document.location.href = "<?= base_url('dashboard/superadmin/changeSubMenuIsActive/'); ?>" + id + '/' + isAct;
            },
            error: function() {
                alert('error');
            }
        });
    });
    // Change User admin Is Active
    $('.isActiveAdmin').on('click', function() {
        const id = $(this).data('id');
        const isAct = $(this).data('ac');
        $.ajax({
            success: function() {
                // alert('success');
                document.location.href = "<?= base_url('dashboard/user/changeAdminIsActive/'); ?>" + id + '/' + isAct;
            },
            error: function() {
                alert('error');
            }
        });
    });
    // Change User customer Is Active
    $('.isActiveCustomer ').on('click', function() {
        const id = $(this).data('id');
        const isAct = $(this).data('ac');
        $.ajax({
            success: function() {
                // alert('success');
                document.location.href = "<?= base_url('dashboard/usercustomer/changeCustomerIsActive/'); ?>" + id + '/' + isAct;
            },
            error: function() {
                alert('error');
            }
        });
    });
    // Change admin Role/Level
    $('.roleAdmin').on('click', function() {
        const id = $(this).data('id');
        const role_id = $(this).data('r');
        $.ajax({
            success: function() {
                // alert('success');
                document.location.href = "<?= base_url('dashboard/user/changeRoleAdmin/'); ?>" + id + '/' + role_id;
            },
            error: function() {
                alert('error');
            }
        });
    });
</script>
<script>
    // Modal view img film 
    $(document).on('click', '.viewIMG', function() {
        const title = $(this).data('vt');
        const img = $(this).data('vi');
        const base_urlIMG = $('#valImg').val();
        $('#imgFilmModalLabel').html(title);
        $('.modal-body .img').attr('src', base_urlIMG + img);
    });

    // Shorting text description film
    function shortingText(value) {
        if (value.length <= 30) {
            return value;
        }
        return value.substring(0, 30) + '...';
    }

    // Modal time add
    $(document).on('click', '.addTime', function() {
        $('#timeModalLabel').html('Add New Time');
        $('.modal-footer button[type=submit]').html('Add');

        const base_url = $('#linkAddTime').val();
        $('.modal-body form').attr('action', base_url);

        $('.modal-body #id').val('');
        $('.modal-body #time').val('');
        $('.modal-body #schedule_id').attr('selected', 'selected').val('');
    });

    // Modal time edit
    $(document).on('click', '.editTime', function() {
        $('#timeModalLabel').html('Edit Time');
        $('.modal-footer button[type=submit]').html('Edit');

        const base_url = $('#linkEditTime').val();
        $('.modal-body form').attr('action', base_url);

        const timeId = $(this).data('id');
        const time = $(this).data('t');
        const scheduleId = $(this).data('si');
        $('.modal-body #id').val(timeId);
        $('.modal-body #time').val(time);
        $('.modal-body #schedule_id').val(scheduleId);
    });
</script>
</body>

</html>