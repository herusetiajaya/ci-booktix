<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Content Row -->
    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger col-lg-4" role="alert">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="col-lg-6">
            <?= form_error('film', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="addFilm btn btn-primary pull-right" data-toggle="modal" data-target="#filmModal">Add New Film</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Poster</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($tblFilm as $film) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $film['title']; ?></td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#imgFilmModal" class="viewIMG" data-vt="<?= $film['title']; ?>" data-vi="<?= $film['img']; ?>">
                                        <img class="img-thumbnail" style="width: 35px; height: 35px;" src="<?= base_url('assets/dashboard/img/img-film/') . $film['img']; ?>">
                                    </a>
                                </td>
                                <td><?= $film['category']; ?></td>
                                <td style="white-space: nowrap; text-overflow: ellipsis; max-width:1px; overflow:hidden;"><?= $film['description']; ?></td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#filmModal" class="editFilm badge badge-primary" data-id="<?= $film['id']; ?>" data-t="<?= $film['title']; ?>" data-c="<?= $film['category']; ?>" data-d="<?= $film['description']; ?>" data-i="<?= $film['img']; ?>">Edit</a>
                                    <a href="<?= base_url('dashboard/bioskop/deletefilm/' . $film['id']) ?>" class="deleteData badge badge-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
</div>
<!-- /.container-fluid -->

<!-- Modal film -->
<div class="modal fade" id="filmModal" tabindex="-1" role="dialog" aria-labelledby="filmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filmModalLabel">Add New film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="">
                    <input type="hidden" class="form-action" id="linkAddfilm" value="<?= base_url('dashboard/bioskop/film') ?>">
                    <input type="hidden" class="form-action" id="linkEditfilm" value="<?= base_url('dashboard/bioskop/editfilm/') ?>">
                    <div class="modal-body">
                        <!-- id -->
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="form-group">
                            <!-- title -->
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <!-- category -->
                            <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category">
                        </div>
                        <div class="form-group">
                            <!-- description -->
                            <!-- <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description"> -->
                            <textarea name="description" rows="3" class="form-control" id="description" placeholder="Enter Description"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="row-sm-4 pl-5 pb-2">Poster</div>
                            <div class="row-sm-9 pl-4">
                                <div class="row">
                                    <div class="col-sm-3" id="img-src">
                                        <input type="hidden" id="valImgDefault" value="<?= base_url('assets/dashboard/img/img-film/default.png') ?>">
                                        <input type="hidden" id="valImg" value="<?= base_url('assets/dashboard/img/img-film/') ?>">
                                        <img src="" alt="" class="img img-thumbnail">
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="custum-file">
                                            <input type="file" class="custom-file-input" id="img" name="img">
                                            <label for="img" class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal view img film -->
<div class="modal fade" id="imgFilmModal" tabindex="-1" role="dialog" aria-labelledby="imgFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imgFilmModalLabel">Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="col-md-9">
                    <input type="hidden" id="valImg" value="<?= base_url('assets/dashboard/img/img-film/') ?>">
                    <img src="" alt="" class="img img-thumbnail">
                </div>
            </div>
            <!-- <div class="modal-footer">
                <a href="" class="badge badge-danger p-2" data-dismiss="modal">Close</a>
            </div> -->
        </div>
    </div>
</div>