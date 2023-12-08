<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- MY css -->
    <link href="<?= base_url('assets/'); ?>frontend/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>frontend/css/bootstrap.css" rel="stylesheet">
    <title><?= $title; ?></title>
</head>

<body>
    <div class="container-fluid bg-secondary">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                <a class="navbar-brand" href="<?= base_url('frontend/home'); ?>">Booktix</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-item nav-link <?= ($title == 'Home page') ? 'active' : '' ?>" href="<?= base_url('frontend/home'); ?>">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link <?= ($title == 'About page') ? 'active' : '' ?>" href="<?= base_url('frontend/about'); ?>">About</a>
                        <a class="nav-item nav-link <?= ($title == 'Film page') ? 'active' : '' ?>" href="<?= base_url('frontend/film'); ?>">Film</a>
                        <a class="nav-item nav-link <?= ($title == 'Login Customer page') ? 'active' : '' ?>" href="<?= base_url('frontend/auth'); ?>">Login Customer</a>
                        <a class="nav-item nav-link" href="<?= base_url('dashboard/auth'); ?>">Login Admin</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>