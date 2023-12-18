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
                    <div class="navbar-nav">
                        <a class="nav-item nav-link <?= ($title == 'Home page') ? 'active' : '' ?>" href="<?= base_url('frontend/home'); ?>">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link <?= ($title == 'About page') ? 'active' : '' ?>" href="<?= base_url('frontend/about'); ?>">About</a>
                        <a class="nav-item nav-link <?= ($title == 'Film page') ? 'active' : '' ?>" href="<?= base_url('frontend/film'); ?>">Film</a>
                        <a class="nav-item nav-link <?= ($title == 'Forum page') ? 'active' : '' ?>" href="<?= base_url('frontend/forum'); ?>">Forum</a>
                        <?php if ($this->session->userdata('usernameCustomer')) : ?>
                            <div class="dropdown show ml-5">
                                <a class="nav-item nav-link <?= ($title == 'Customer page') ? 'active' : '' ?> dropdown-toggle" href="" role="a" id="dropdownMenuLink" data-toggle="dropdown" data-target="#dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span"><?= $this->session->userdata('usernameCustomer'); ?></span>
                                </a>
                                <div class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item nav-item nav-link bg-dark" href="<?= base_url('frontend/customer'); ?>">
                                        <i class="fa fa-id-card fa-sm fa-fw mr-2 text-gray-400"></i>
                                        My Profile
                                    </a>
                                    <a class="dropdown-item nav-item nav-link bg-dark" href="">
                                        <i class="fa fa-ticket fa-sm fa-fw mr-2 text-gray-400"></i>
                                        My Ticket
                                    </a>
                                    <a class="dropdown-item nav-item nav-link bg-dark submit-logout" href="">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </div>

                        <?php else : ?>
                            <a class="nav-item nav-link <?= ($title == 'Login page') ? 'active' : '' ?>" href="<?= base_url('frontend/auth'); ?>">
                                <span class="pl-5">Login</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>