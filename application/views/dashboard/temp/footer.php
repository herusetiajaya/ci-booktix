<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; CodeIgniter 3.10 <?= date('Y'); ?></span>
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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('dashboard/auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- About Modal -->
<div class="modal fade" id="aboutApp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">About this App</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Booktix<br>
                Booking Ticket Film Online<br>
                By Heru Setiawan :v<br>
                wkwk
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>dashboard/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>dashboard/js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/'); ?>dashboard/js/sweetalert2.all.min.js"></script>
<script>
    // Image edit user
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    // delete Data SweetAlert2
    $('.deleteData').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Make sure to delete it?',
            text: "Delete will be permanent",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
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
    // Add SUB MENU MODAL
    $(document).on('click', '.addSubMenuModal', function() {
        $('#subMenuModalLabel').html('Add New Sub Menu');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', "<?= base_url('dashboard/superadmin/submenu'); ?>");

        $('.modal-body #title').val('');
        $('.modal-body #menu_id').val('defaultSelect');
        $('.modal-body #url').val('');
        $('.modal-body #icon').val('');
    });
    // Edit SUB MENU MODAL
    $(document).on('click', '.editSubMenuModal', function() {
        $('#subMenuModalLabel').html('Edit Sub Menu');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', "<?= base_url('dashboard/superadmin/editsubmenu'); ?>");
        const subMenuId = $(this).data('id');
        const title = $(this).data('title');
        const menuId = $(this).data('menu_id');
        const urlSubMenu = $(this).data('url');
        const icon = $(this).data('icon');
        // const isActive = $(this).data('isActive');
        $('.modal-body #id').val(subMenuId);
        $('.modal-body #title').val(title);
        $('.modal-body #menu_id').val(menuId);
        $('.modal-body #url').val(urlSubMenu);
        $('.modal-body #icon').val(icon);
        // $('.modal-body #is_active').val(isActive);
    });
    // Add user admin
    $(document).on('click', '.addAdmin', function() {
        $('#adminModalLabel').html('Add New Admin');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', "<?= base_url('dashboard/user/addadmin'); ?>");
        $('.modal-body #username').val('');
        $('.modal-body #name').val('');
        $('.modal-body #email').val('');
        $('.modal-body #password1').val('');
        $('.modal-body #password2').val('');
    });
</script>
<script>
    // Change Access Role
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
    // logout
    $('.submit-logout').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Ready to Leave?',
            text: 'Select "Logout" below if you are ready to end your current session.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout!'
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= base_url('dashboard/auth/logout'); ?>"
            }
        })
    });
</script>

<!-- <script src="<?= base_url('assets/'); ?>dashboard/js/dashboard-script.js"></script> -->
<!-- <script src="<?= base_url('assets/'); ?>js/myscript.js"></script> -->
</body>

</html>