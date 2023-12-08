<div class="container-fluid mt-1 bg-light">
    <div class="container">
        <footer class="sticky-footer rounded-bottom">

            <div class="container p-4 my-3 bg-dark rounded">
                <div class="copyright text-center my-auto">
                    <span class="text-white">Copyright &copy; Heru Setiawan <?= date('Y'); ?></span>
                </div>
            </div>

        </footer>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url('assets/'); ?>frontend/js/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>frontend/js/bootstrap.js"></script>
<script src="<?= base_url('assets/'); ?>frontend/js/sweetalert2.all.min.js"></script>

<!-- <script src="<?= base_url('assets/'); ?>frontend/js/myscript.js"></script> -->
<script>
    // HOME PAGE
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

    // slide image home
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

    // slide image about
    // let slideIndex1 = 1;
    // showDivs(slideIndex1);

    // function plusDivs(n) {
    //     showDivs((slideIndex1 += n));
    // }

    // function showDivs(n) {
    //     let i;
    //     let imgList = document.getElementsByClassName('img-slideshow-about');
    //     if (n > imgList.length) slideIndex1 = 1;
    //     else if (n < 1) slideIndex1 = imgList.length;
    //     for (i = 0; i < imgList.length; i++) {
    //         imgList[i].style.display = 'none';
    //     }
    //     imgList[slideIndex1 - 1].style.display = 'block';
    // }
    // setInterval(() => {
    //     plusDivs(1);
    // }, 1000);
</script>

</body>

</html>