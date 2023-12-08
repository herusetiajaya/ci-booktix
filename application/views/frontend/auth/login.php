<div class="container mt-3">
    <div class="card-header bg-info">

        <h5 class="display-7 text-white">Login page</h5>

        <!-- Outer Row  Login Customer-->
        <div class="row justify-content-center">

            <div class="col-lg-4">

                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                    </div>

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-4">
                                <div class="small d-flex justify-content-end">
                                    <a href="<?= base_url('dashboard/auth'); ?>" class="small badge badge-secondary"> Admin page &raquo;
                                    </a>
                                </div>
                                <div class="text-center">
                                    <h1 class="h5 text-gray-900 mb-3">Login Booktix</h1>
                                    <?= $this->session->flashdata('message'); ?>
                                </div>
                                <form class="user" method="post" action="<?= base_url('frontend/auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username" value="<?= set_value('username'); ?>">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('frontend/auth/forgotpassword'); ?>">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('frontend/auth/registration') ?>">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

</div>