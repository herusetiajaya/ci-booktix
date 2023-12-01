<!-- Page Wrapper -->
<div id="wrapper" class="container mt-5 bg-gradient-primary">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div class="text-center bg-gradient-success" id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid mt-5 mb-5">
                <!-- 404 Error Text -->
                <div class="row justify-content-center mt-3 text-center">
                    <div class="card justify-content-center">
                        <div class="card-body text-lg-left">
                            <div class="card-header mb-4 bg-info">
                                <h1 class="text-center text-white">This is Email wkwk</h1>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <h3 class="card-subtitle mb-3 text-muted">From</h3>
                                    <h5 class="card-subtitle mb-3 text-muted">Subject</h5>
                                    <h5 class="card-subtitle mb-3 text-muted">To</h5>
                                    <h5 class="card-subtitle mb-2 text-muted">Token</h5>
                                    <p class="lead text-gray-800 mb-2 font-weight-bold">Message</p>
                                </div>
                                <div>
                                    <h3 class="card-subtitle mb-3 text-muted">: <?= $emailFrom; ?></h3>
                                    <h5 class="card-subtitle mb-3 text-muted">: <?= $emailSubject; ?></h5>
                                    <h5 class="card-subtitle mb-3 text-muted">: <?= $emailTo; ?></h5>
                                    <h5 class="card-subtitle mb-2 text-muted">: <?= $token; ?></h5>
                                    <p class="lead text-gray-800 mb-1 font-weight-bold">: Click this link to verify you account</p>
                                    <p class="lead text-gray-800 mb-1 font-italic"><a href="<?= base_url('auth/verify?email='); ?><?= $emailTo; ?>&token=<?= urlencode($token); ?> ">&raquo verify to activation here &laquo</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->