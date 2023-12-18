<!-- Begin Page Content -->
<div class="container mt-3 mb-4">
    <div class="card-header bg-info">
        <h3 class="text text-white"><?= $title; ?></h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card o-hidden border-0 shadow-lg mb-4">
                    <div class="card-body p-0">
                    </div>
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg d-flex justify-content-center">
                            <div class="pt-3 pr-3">
                                <div class="container-fluid">
                                    <?= form_open_multipart('frontend/customer/edit/'); ?>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">Picture</div>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <img src="<?= base_url('assets/frontend/img/profile/') . $user['image']; ?>" alt="" class="img img-thumbnail">
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="custum-file">
                                                        <input type="file" class="custom-file-input" id="image" name="image"><label for="image" class="custom-file-label">Choose file</label>
                                                    </div>

                                                    <div class="form-group row mt-4  ml-5">
                                                        <label for="car_id" class="col-sm-3 small">Card ID</label>
                                                        <div class="col-sm-">
                                                            <input type="text" class="small border-info rounded" id="car_id" name="card_id" value="<?= $user['card_id']; ?>">
                                                        </div>
                                                        <?= form_error('card_id', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group row mt-1 ml-5">
                                                        <label for="phone" class="col-sm-3 small">Phone</label>
                                                        <div class="col-sm-">
                                                            <input type="text" class="small border-info rounded" id="phone" name="phone" value="<?= $user['phone']; ?>">
                                                        </div>
                                                        <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group row mt-1 ml-5">
                                                        <label for="address" class="col-sm-3 small">Address</label>
                                                        <div class="col-sm-">
                                                            <textarea class="small border-info rounded" id="address" name="address"><?= $user['address']; ?></textarea>
                                                        </div>
                                                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                            <a href="<?= base_url('frontend/customer/') ?>"><button type="button" class="btn btn-danger">Cencel</button></a>
                                        </div>
                                    </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->