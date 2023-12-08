<div class="container mt-3">
    <div class="card-header bg-info">

        <h5 class="display-7 text-white">Forgot Password</h5>

        <!-- Outer Row  Forgot Password-->
        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-lg-4">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-4">
                                        <div class="text-center">
                                            <h1 class="h5 text-gray-900 mb-3">Forgot your password ?</h1>
                                        </div>
                                        <?= $this->session->flashdata('message'); ?>
                                        <form class="user" method="post" action="<?= base_url('frontend/auth/forgotpassword'); ?>">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Reset Password
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= base_url('frontend/auth') ?>">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>