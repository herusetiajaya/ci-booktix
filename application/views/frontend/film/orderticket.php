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
                    <div class="card shadow col-lg- mx-1 mb-3">
                        <div class="row-lg-3 text-center">
                            <small class="">Ticket</small>
                        </div>
                        <form action="<?= base_url('frontend/film/orderticket/') ?>" method="post">

                            <div class="row m-2 border bg-info text-white" style="border-radius: 10px;">
                                <div class="col-lg-4 text-center pt-2">
                                    <div class="card overflow-hidden border-0 h-75" style="max-height: 155px;">
                                        <img src="<?= base_url('assets/dashboard/img/img-film/') . $film['img']; ?>" class="rounded-bottom rounded-top position-relative">
                                    </div>
                                    <small><?= $film['title']; ?></small>
                                </div>
                                <div class="col-lg-7 border-left">
                                    <div class="col-lg- ">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless text-white" id="dataTable" width="100%" cellspacing="0">
                                                <tfoot>
                                                    <tr>
                                                        <td class="col-4"><small>Ordered By</small></td>
                                                        <td class="col-1">:</td>
                                                        <td>
                                                            <small>
                                                                <input type="text" class="bg-info text-white border-0  w-100" name="film" id="film" readonly value="<?= $user['name']; ?>">
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Date</small></td>
                                                        <td>:</td>
                                                        <td>
                                                            <small>
                                                                <input type="text" class="bg-info text-white border-0 w-75" name="date" id="date" readonly value="<?= $detailTicket['date']; ?>">
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Time</small></td>
                                                        <td>:</td>
                                                        <td>
                                                            <small>
                                                                <input type="text" class="bg-info text-white border-0 w-75" name="time" id="time" readonly value="<?= $detailTicket['time']; ?>">
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Studio</small></td>
                                                        <td>:</td>
                                                        <td>
                                                            <small>
                                                                <input type="text" class="bg-info text-white border-0 w-75" name="studio" id="studio" readonly value="<?= $detailTicket['studio']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Seat</small></td>
                                                        <td>:</td>
                                                        <td>
                                                            <small>
                                                                <input type=" text" class="bg-info text-white border-0 w-75" name="seat" id="seat" readonly value="<?= $detailTicket['seat']; ?>">
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Ticket</small></td>
                                                        <td>:</td>
                                                        <td>
                                                            <small>
                                                                <input type=" text" class="bg-info text-white border-0 w-75" name="ticket" id="ticket" readonly value="1">
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Price</small></td>
                                                        <td>:</td>
                                                        <td>
                                                            <small>
                                                                <input type=" text" class="bg-info text-white border-0 w-75" name="price" id="price" readonly value="<?= rupiah($schedule['price']); ?>">
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-2 p-1 pr-3 border d-flex justify-content-end bg-dark text-white" style="border-radius: 10px;">
                                <input type="hidden" class="bg-info text-white border-0" name="tprice" id="tprice" readonly value="">
                                <span>Total : <?= rupiah($schedule['price']); ?></span>
                            </div>
                            <div class="row-lg m-2 mb-3 pr-2 d-flex justify-content-end">
                                <a href="#" class="badge badge-primary p-2">Continue Order</a>
                                <a href="<?= base_url('frontend/film/index/') ?>" class="badge badge-danger ml-2 p-2">Cencel</a>
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