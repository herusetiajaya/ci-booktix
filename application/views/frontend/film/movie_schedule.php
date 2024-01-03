<div class="container mt-3 mb-4">
    <div class="card-header bg-success">
        <h1 class="text text-white d-flex justify-content-center">Movie Schedule</h1>
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger col-lg-" role="alert">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="row bg-white pt-3 pl-3 rounded-bottom rounded-top">

            <div class="col-lg-3 d-flex justify-content-end">
                <div class="card shadow col-lg mb-3" style="height: 300px;">
                    <form action="" method="post" class="form">
                        <div class="row-lg- text-center">
                            <small class="">Detail Ticket</small>
                        </div>
                        <div class="col-lg- mb-3">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless table-dark" style="border-radius: 10px;" id="dataTable" width="100%" cellspacing="0">
                                    <tfoot>
                                        <tr>
                                            <td class="col-2"><small>Film</small></td>
                                            <td class="col-1">:</td>
                                            <td>
                                                <small>
                                                    <input type="text" class="bg-dark text-white border-0  w-100" name="film" id="film" readonly required value="<?= $tblFilm['title']; ?>">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><small>Date</small></td>
                                            <td>:</td>
                                            <td>
                                                <small>
                                                    <input type="text" class="bg-dark text-white border-0 w-75" name="date" id="date" readonly required value="" placeholder="--/--/---">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><small>Price</small></td>
                                            <td>:</td>
                                            <td>
                                                <small>
                                                    <input type="text" class="bg-dark text-white border-0 w-75" name="price" id="price" readonly required value="" placeholder="Rp. 0">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><small>Time</small></td>
                                            <td>:</td>
                                            <td>
                                                <small>
                                                    <input type="text" class="bg-dark text-white border-0 w-75" name="time" id="time" readonly required value="" placeholder="00:00">
                                                </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><small>Studio</small></td>
                                            <td>:</td>
                                            <td>
                                                <small>
                                                    <input type="text" class="bg-dark text-white border-0 w-75" name="studio" id="studio" readonly required value="" placeholder="Studio 0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><small>Seat</small></td>
                                            <td>:</td>
                                            <td>
                                                <small>
                                                    <input type=" text" class="bg-dark text-white border-0" name="seat" id="seat" readonly required value="" placeholder="X1" style="width: 26px;">
                                                    <small class="h5 mr-1" id="comaSeat2" hidden>,</small>
                                                    <input type=" text" class="bg-dark text-white border-0" name="seat2" id="seat2" hidden readonly required value="" placeholder="X2" style="width: 26px;">
                                                    <small class="h5 mr-1" id="comaSeat3" hidden>,</small>
                                                    <input type=" text" class="bg-dark text-white border-0" name="seat3" id="seat3" hidden readonly required value="" placeholder="X3" style="width: 26px;">
                                                </small>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row-lg mb-3">
                            <?php if ($this->session->userdata('usernameCustomer')) : ?>
                                <button type="submit" class="submitForm btn badge badge-primary text-white p-2 border-0 ">Order Ticket Now</button>
                            <?php else : ?>
                                <a href="<?= base_url('frontend/auth/') ?>" class="submitOrder submitForm badge badge-primary p-2 border-0">Order Ticket Now</a>
                            <?php endif; ?>
                            <a href="<?= base_url('frontend/film/index/') ?>" class="badge badge-danger p-2">Cencel</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="col-lg- d-flex justify-content-center">
                    <div class="card shadow col-lg-5 mx-3 mb-3">
                        <div class="row-lg-3 text-center">
                            <small class="">Set a Schedule</small>
                            <hr class="m-0">
                        </div>
                        <div class="row-lg-3 mb-3 mt-3">
                            <div class="lg pl-2">
                                <div class="lg d-flex justify-content-center">
                                    <!-- Date Schedule -->
                                    <select name="sch_id" id="sch_id" class="form-control form-control-sm w-50 d-flex justify-content-center">
                                        <option value="">Select Date</option>
                                        <?php foreach ($tblSchedule as $schedule) : ?>
                                            <option value="<?= $schedule['id']; ?>"><?= $schedule['date']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="ml-2" id=setST>
                                    <!-- <a href="#" data-t="" class="atime badge badge-success p-2 mt-3 mr-2"></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    <div class="card shadow col-lg- mx-3 mb-3">
                        <div class="row-lg-3 text-center">
                            <small class="">Set a Seat</small>
                            <hr class="m-0">
                        </div>
                        <div class="col-lg mb-3 mt-3">
                            <div class="row">
                                <div class="col-lg-9">
                                    <?php foreach ($tblStudio as $studio) : ?>
                                        <?php if ($studio['is_active'] == 1) : ?>
                                            <a href="#" data-id="<?= $studio['id']; ?>" data-s="<?= $studio['name']; ?>" class="astudio badge badge-success pl-1 pr-1 pb-1 mr-1"><small><?= $studio['name'] ?></small></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-lg-3 d-flex">
                                    <label for="seatCount" class="mr-1 small">Seat Count :</label>
                                    <select name="seatCount" id="seatCount" class="form-control form-control-sm h-75 p-0 border-0" style="width: 35px;">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <div class="col-lg-9 ml-2">
                                <div class="col-lg d-flex justify-content-center p-0 m-0">
                                    <a class="col-lg-7 text-white badge badge-info rounded m-0 p-0">Screen</a>
                                </div>
                                <div class="col-lg d-flex justify-content-center p-0 m-0">
                                    <div class="col-lg- ml-4 mb-3 pt-3" id=setSeat>
                                        <!-- <a href="#" data-t="" style="width: 40px; pointer-events:none;" class="aseat badge badge-info p-2 mt-3 mr-1"><small>A1</small></a> -->
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