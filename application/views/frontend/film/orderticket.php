<div class="container mt-3 mb-4">
    <div class="card-header bg-success">
        <h1 class="text text-white d-flex justify-content-center">Detail Order</h1>
        <div class="row bg-white pt-3 pl-1 rounded-bottom rounded-top">

            <div class="col-lg-3 d-flex justify-content-end">
                <div class="card shadow col-lg mb-3" style="height: 300px;">
                    <div class="row-lg- text-center">
                        <small class="">Popcorn and Drink</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="col-lg">
                    <div class="card shadow col-lg- mx-1 mb-3 bg-dark">
                        <div class="row-lg-3 text-center">
                            <h4 class="text-white">Ticket</h4>
                        </div>
                        <form action="<?= base_url('frontend/film/orderticket/') ?>" method="post">
                            <div class="row m-2 border bg-secondary text-white" style="border-radius: 10px;">
                                <div class="col-lg-4 text-center pt-2">
                                    <div class="card overflow-hidden border-0 h-75" style="max-height: 155px;">
                                        <img src="<?= base_url('assets/dashboard/img/img-film/') . $film['img']; ?>" class="rounded-bottom rounded-top position-relative">
                                    </div>
                                    <small><?= $film['title']; ?></small>
                                </div>
                                <div class="col-lg-7 border-left">
                                    <div class="col-lg- ">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless text-white small" id="dataTable" width="100%" cellspacing="0">
                                                <tfoot>
                                                    <tr>
                                                        <td style="width: 83px;">Ordered By</td>
                                                        <td class="col-1">:</td>
                                                        <td>
                                                            <input type="text" class="bg-secondary text-white border-0  w-100" name="film" id="film" readonly value="<?= $user['name']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ticket Count</td>
                                                        <td>:</td>
                                                        <td>
                                                            <input type="text" class="bg-secondary text-white border-0 w-75" name="ticket" id="ticket" readonly value="<?= $detailTicket['tickCount']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>:</td>
                                                        <td>
                                                            <input type="text" class="bg-secondary text-white border-0 w-75" name="date" id="date" readonly value="<?= $detailTicket['date']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Time</td>
                                                        <td>:</td>
                                                        <td>
                                                            <input type="text" class="bg-secondary text-white border-0 w-75" name="time" id="time" readonly value="<?= $detailTicket['time']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Studio</td>
                                                        <td>:</td>
                                                        <td>
                                                            <input type="text" class="bg-secondary text-white border-0 w-75" name="studio" id="studio" readonly value="<?= $detailTicket['studio']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Seat</td>
                                                        <td>:</td>
                                                        <td>
                                                            <input type="text" class="bg-secondary text-white border-0" name="seat" id="seat" readonly value="<?= $detailTicket['seat']; ?>" style="width: 26px;">
                                                            <small class="h5 mr-1" id="comaSeat2">,</small>
                                                            <input type="text" class="bg-secondary text-white border-0" name="seat2" id="seat2" readonly required value="<?= $detailTicket['seat2']; ?>" placeholder="X2" style="width: 26px;">
                                                            <small class="h5 mr-1" id="comaSeat3">,</small>
                                                            <input type="text" class="bg-secondary text-white border-0" name="seat3" id="seat3" readonly required value="<?= $detailTicket['seat3']; ?>" placeholder="X3" style="width: 26px;">
                                                        </td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td>Price</td>
                                                        <td>:</td>
                                                        <td>
                                                            <input type="text" class="bg-secondary text-white border-0 w-75" name="price" id="price" readonly value="<?= rupiah($schedule['price']); ?>">
                                                        </td>
                                                    </tr> -->
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-2 p-1 pl-3 border bg-secondary text-white" style="border-radius: 10px;">
                                <input type="hidden" class="bg-secondary text-white border-0" name="tprice" id="tprice" readonly value="">
                                <span>Total Price : <?= rupiah($price); ?></span>
                            </div>
                            <div class="row-lg m-2 mb-3 pr-2 d-flex justify-content-end">
                                <a href="#" class="badge badge-primary p-2">Continue Order</a>
                                <a href="<?= base_url('frontend/film/cencelOrder/') ?>" class="badge badge-danger ml-2 p-2">Cencel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 d-flex justify-content-end">
                <div class="card shadow col-lg mb-3" style="height: 300px;">
                    <div class="row-lg- text-center">
                        <small class="">Payment via Transfer</small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>