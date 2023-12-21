<div class="container mt-3 mb-4">
    <div class="card-header bg-success">
        <h1 class="text text-white d-flex justify-content-center"><?= $tblFilm['title']; ?></h1>
        <div class="row bg-white pt-3 pl-3 rounded-bottom rounded-top">

            <div class="card shadow col-3 mx-3 mb-3 overflow-auto" style="max-height: 315px;">
                <img src="<?= base_url('assets/dashboard/img/img-film/') . $tblFilm['img']; ?>" class="m-1 rounded-bottom rounded-top position-relative">
            </div>

            <div class="card shadow col-8 mx-3 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <small>Category : <?= $tblFilm['category']; ?></small></br>
                            <small>Description : </br><?= $tblFilm['description'] ?></h4></small></br></br>
                            <div class="row-lg-3">
                                <a href="" class="badge badge-warning p-2">Trailer</a>
                            </div>
                            <div class="row-lg-3 mt-5">
                                <a href="<?= base_url('frontend/film/movieSchedule/') . $tblFilm['id']; ?>" class="badge badge-primary p-2">Set a schedule</a>
                                <a href="javascript:history.back()" class="badge badge-secondary p-2">Back</a>
                            </div>
                        </div>
                        <div class="col-lg-3 border-left">
                            <small>Rating : ?</small><br>
                            <small>Duration : ?</small><br>
                            <small>Production : ?</small><br>
                            <small>Director : ?</small><br>
                            <small>Writer : ?</small><br>
                            <small>Cast : ?</small><br>
                            <small>Distributor : ?</small><br>
                            <small>Year : ?</small><br>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>