<div class="container-fluid mt-1 bg-light">
    <div class="container">
        <footer class="sticky-footer rounded-bottom">

            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span class="text-drak">Copyright &copy; Heru Setiawan <?= date('Y'); ?></span>
                </div>
            </div>

        </footer>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Optional JavaScript -->
<!-- Bootstrap core JavaScript-->
<!-- <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- Core plugin JavaScript-->
<!-- <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script> -->
<!-- Custom scripts for all pages-->
<!-- <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script> -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url('assets/'); ?>js/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.js"></script>
<script src="<?= base_url('assets/'); ?>js/sweetalert2.all.min.js"></script>
<script>
    // SweetAlert 
    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            title: 'Data Mahasiswa ',
            text: 'Berhasil ' + flashData,
            icon: 'success'
        });

    }

    // tombol-hapus
    $('.tombol-hapus').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "data mahasiswa akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
    // end SweetAlert
</script>
<script>
    // judul welcome
    // const txtElement = ['Motherfucker', 'Bitches', 'Idiot'];
    const txtElement = ['Human', 'Stanger', 'Robot', 'Student', 'Mr./Mrs'];
    let count = 0;
    let txtIndex = 0;
    let currentTxt = '';
    let words = '';

    (function tik() {

        if (count == txtElement.length) {
            count = 0;
        }

        currentTxt = txtElement[count];

        words = currentTxt.slice(0, ++txtIndex);
        document.querySelector('.efek-tik').textContent = words;

        if (words.length == currentTxt.length) {
            count++;
            txtIndex = 0;
        }

        setTimeout(tik, 500);


    })();
    //end js judul welcome

    // slide foto profile
    let slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs((slideIndex += n));
    }

    function showDivs(n) {
        let i;
        let imgList = document.getElementsByClassName('img-slideshow');
        if (n > imgList.length) slideIndex = 1;
        else if (n < 1) slideIndex = imgList.length;

        for (i = 0; i < imgList.length; i++) {
            imgList[i].style.display = 'none';
        }

        imgList[slideIndex - 1].style.display = 'block';
    }

    setInterval(() => {
        plusDivs(1);
    }, 1000);
    // end slide foto profile
</script>
<!-- <script src="<?= base_url('assets/'); ?>js/myscript.js"></script> -->

</body>

</html>