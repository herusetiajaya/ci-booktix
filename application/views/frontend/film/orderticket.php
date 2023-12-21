<div class="container mt-3 mb-4">
    <div class="card-header bg-success">
        <h1 class="text text-white d-flex justify-content-center">Detail Order</h1>
        <div class="row bg-white pt-3 pl-1 rounded-bottom rounded-top">

            <div class="col-lg-3 d-flex justify-content-end">
                <div class="card shadow col-lg mb-3" style="height: 300px;">
                    <div class="row-lg- text-center">
                        <small class="">Drinking</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="col-lg">
                    <div class="card shadow col-lg- mx-1 mb-3">
                        <div class="row-lg-3 text-center">
                            <small class="">Detail Ticket</small>
                            <hr class="m-0">
                            <p><?= $user['username']; ?></p>
                            <p><?= $user['name']; ?></p>
                            <p><?= $detailTicket['film']; ?></p>
                            <p><?= $detailTicket['date']; ?></p>
                            <p><?= $detailTicket['price']; ?></p>
                            <p><?= $detailTicket['time']; ?></p>
                            <p><?= $detailTicket['studio']; ?></p>
                            <p><?= $detailTicket['seat']; ?></p>
                            <div class="row-lg mb-3">
                                <a href="#" class="badge badge-primary p-2">Continue Order</a>
                                <a href="javascript:history.back()" class="badge badge-secondary p-2">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 d-flex justify-content-end">
                <div class="card shadow col-lg mb-3" style="height: 300px;">
                    <div class="row-lg- text-center">
                        <small class="">Popcorn</small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>