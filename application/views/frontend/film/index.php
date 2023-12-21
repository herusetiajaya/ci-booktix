<div class="container mt-3 mb-4">
    <div class="card-header bg-success">
        <h3 class="text text-white">Film page</h3>
        <h1 class="text text-white d-flex justify-content-center">New a Movie Today</h1>
        <div class="row bg-white pt-3 pl-3 rounded-bottom rounded-top">

            <?php foreach ($tblFilm as $film) : ?>
                <a href="<?= base_url('frontend/film/viewFilm/') . $film['id']; ?>" class="card shadow col-2 mx-3 mb-3 overflow-hidden" style="max-height: 217px;">
                    <div class="bg-success mt-2 text-white text-center rounded-bottom rounded-top">
                        <small class="d-flex justify-content-center"><?= $film['title'] ?></small>
                    </div>
                    <img src="<?= base_url('assets/dashboard/img/img-film/') . $film['img']; ?>" class="m-1 rounded-bottom rounded-top position-static">
                </a>
            <?php endforeach; ?>

        </div>
    </div>
</div>