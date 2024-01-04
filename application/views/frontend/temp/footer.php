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

<!-- <?= "<script>" . $this->session->flashdata('message-swal') . "</script>" ?> -->
<!-- <script src="<?= base_url('assets/'); ?>frontend/js/myscript.js"></script> -->

<script>
    // Image edit user
    $('.custom-file-input').on('change', function() {
        // change filename
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);

        // change img
        const input = this;
        const url = $(this).val();
        const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('.img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('.img').attr('src', 'default.png');
        }
    });
    // logout
    $('.submit-logout').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Ready to Leave?',
            text: 'Select "Logout" below if you are ready to end your current session.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout!'
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= base_url('frontend/auth/logout'); ?>"
            }
        })
    });
</script>

<script>
    // HOME PAGE
    // const txtElement = ['Motherfucker', 'Bitches', 'Idiot'];
    // const txtElement = ['Human', 'Stanger', 'Robot', 'Student', 'Mr./Mrs'];
    const txtElement = ['Good people', 'Handsome', 'Beautiful'];
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
</script>

<!-- MOVIE PAGE -->
<script>
    // set a schedule
    $('#sch_id').on('change', function() {
        const schId = $('#sch_id').val();
        $('#time').val('');
        $.ajax({
            url: '<?= base_url('frontend/film/getSchedule'); ?>',
            data: {
                id: schId
            },
            type: 'POST',
            dataType: 'json',
            cache: false,
            context: this,
            success: function(data) {
                // alert(data);
                $('#date').val(data.date);
                const val = data.price;
                let sc = $('#ticketCount').val();
                let result = val * sc;
                const rpTotal = 'Rp. ' + result;
                $('#price').val(rpTotal);
                $('#message').val(data.message);
                $('#id').val(data.id);
            },
            error: function() {
                alert('error');
            }
        });
    });
    // set a time
    $('#sch_id').on('change', function() {
        const schIda = $('#sch_id').val();
        $('#setST').empty();

        $.ajax({
            url: '<?= base_url('frontend/film/getTime'); ?>',
            data: {
                id: schIda
            },
            type: 'POST',
            dataType: 'json',
            cache: false,
            context: this,
            success: function(data) {
                $.each(data, function(i, val) {
                    let e = $('<a href="#" data-t="' + val.time + '">' + val.time + '</a>');
                    $('#setST').append(e);
                    e.attr('class', 'atime badge badge-success mr-2 p-2 mt-3');
                    $('.atime').on('click', function() {
                        const time = $(this).data('t');
                        $('#time').val(time);
                    });
                });
            },
            error: function() {
                alert('error');
            }
        });
    });

    // set a studio get a seat
    $('.astudio').on('click', function() {
        const nameStudio = $(this).data('s');
        const idStudio = $(this).data('id');
        const seatCount = $('#ticketCount').val();
        $('#studio').val(nameStudio);
        $('#seat').val('');
        $('#seat2').val('');
        $('#seat3').val('');
        $('#setSeat').empty();

        $.ajax({
            url: '<?= base_url('frontend/film/getSeat'); ?>',
            data: {
                id: idStudio
            },
            type: 'POST',
            dataType: 'json',
            cache: false,
            context: this,
            success: function(data) {
                const seat_count = seatCount;
                if (seat_count == 1) {
                    // alert('jumlah kursi 1');
                    $.each(data, function(i, val) {
                        if (val.ordered == '1') {
                            let e = $('<a href="#" style="width: 37px; pointer-events: none;" data-st="' + val.code_seat + '"><small>' + val.code_seat + '</small></a>');
                            $('#setSeat').append(e);
                            e.attr('class', 'badge badge-warning mr-2 mt-1');
                        } else {
                            let e = $('<a href="#" style="width: 37px;" data-st="' + val.code_seat + '"><small>' + val.code_seat + '</small></a>');
                            $('#setSeat').append(e);
                            e.attr('class', 'aseat ' + val.code_seat + ' badge badge-info mr-2 mt-1').hover(function(m) {
                                $(this).css('background', m.type === 'mouseenter' ? 'orange' : '#17a2b8');
                            });
                            $('.' + val.code_seat + '').on('click', function() {
                                $('.aseat').css('background', '#17a2b8');
                                $('.aseat').hover(function(m) {
                                    $(this).css('background', m.type === 'mouseenter' ? 'orange' : '#17a2b8');
                                });
                                $('.' + val.code_seat + '').hover(function(m) {
                                    $(this).css('background', m.type === 'mouseenter' ? '#17a2b8' : 'orange');
                                });
                                const seat = $(this).data('st');
                                $('#seat').val(seat);
                            });
                        }
                    });
                } else if (seat_count == 2) {
                    // alert('jumlah kursi 2');
                    let n = 0;
                    $.each(data, function(i, val) {
                        if (val.ordered == '1') {
                            let e = $('<a href="#" style="width: 37px; pointer-events: none;" data-st="' + val.code_seat + '"><small>' + val.code_seat + '</small></a>');
                            $('#setSeat').append(e);
                            e.attr('class', 'badge badge-warning mr-2 mt-1');
                        } else {
                            let e = $('<a href="#" style="width: 37px;" data-st="' + val.code_seat + '"><small>' + val.code_seat + '</small></a>');
                            $('#setSeat').append(e);
                            e.attr('class', 'aseat ' + val.code_seat + ' badge badge-info mr-2 mt-1').hover(function(m) {
                                $(this).css('background', m.type === 'mouseenter' ? 'orange' : '#17a2b8');
                            });
                            $('.' + val.code_seat + '').on('click', function() {
                                n++;
                                if (n > seat_count) {
                                    $('.aseat').off('click');
                                    alert('max seat count 2')
                                } else if (n == 1) {
                                    $('.' + val.code_seat + '').hover(function(m) {
                                        $(this).css('background', m.type === 'mouseenter' ? '#17a2b8' : 'orange');
                                    });
                                    const seat = $(this).data('st');
                                    $('#seat').val(seat);
                                } else if (n == 2) {
                                    $('.' + val.code_seat + '').hover(function(m) {
                                        $(this).css('background', m.type === 'mouseenter' ? '#17a2b8' : 'orange');
                                    });
                                    const seat = $(this).data('st');
                                    $('#seat2').val(seat);
                                }
                            });
                        }
                    });
                }else if (seat_count == 3) {
                    // alert('jumlah kursi 3');
                    let n = 0;
                    $.each(data, function(i, val) {
                        if (val.ordered == '1') {
                            let e = $('<a href="#" style="width: 37px; pointer-events: none;" data-st="' + val.code_seat + '"><small>' + val.code_seat + '</small></a>');
                            $('#setSeat').append(e);
                            e.attr('class', 'badge badge-warning mr-2 mt-1');
                        } else {
                            let e = $('<a href="#" style="width: 37px;" data-st="' + val.code_seat + '"><small>' + val.code_seat + '</small></a>');
                            $('#setSeat').append(e);
                            e.attr('class', 'aseat ' + val.code_seat + ' badge badge-info mr-2 mt-1').hover(function(m) {
                                $(this).css('background', m.type === 'mouseenter' ? 'orange' : '#17a2b8');
                            });
                            $('.' + val.code_seat + '').on('click', function() {
                                n++;
                                if (n > seat_count) {
                                    $('.aseat').off('click');
                                    alert('max seat count 3')
                                } else if (n == 1) {
                                    $('.' + val.code_seat + '').hover(function(m) {
                                        $(this).css('background', m.type === 'mouseenter' ? '#17a2b8' : 'orange');
                                    });
                                    const seat = $(this).data('st');
                                    $('#seat').val(seat);
                                } else if (n == 2) {
                                    $('.' + val.code_seat + '').hover(function(m) {
                                        $(this).css('background', m.type === 'mouseenter' ? '#17a2b8' : 'orange');
                                    });
                                    const seat = $(this).data('st');
                                    $('#seat2').val(seat);
                                } else if (n == 3) {
                                    $('.' + val.code_seat + '').hover(function(m) {
                                        $(this).css('background', m.type === 'mouseenter' ? '#17a2b8' : 'orange');
                                    });
                                    const seat = $(this).data('st');
                                    $('#seat3').val(seat);
                                }
                            });
                        }
                    });
                }
            },
            error: function() {
                alert('error');
            }
        });
    });

    // Ticket Count
    $('#ticketCount').on('change', function() {
        $('#sch_id').val('');
        $('#date').val('');
        $('#price').val('');
        $('#time').val('');
        $('#studio').val('');
        $('#seat').val('');
        $('#seat2').val('');
        $('#seat3').val('');

        $('#setST').empty();
        $('#setSeat').empty();

        if ($('#ticketCount').val() == 1) {
            $('#comaSeat2').attr('hidden', true);
            $('#seat2').attr('hidden', true);
            $('#comaSeat3').attr('hidden', true);
            $('#seat3').attr('hidden', true);
        } else if ($('#ticketCount').val() == 2) {
            $('#comaSeat2').attr('hidden', false);
            $('#seat2').attr('hidden', false);
            $('#comaSeat3').attr('hidden', true);
            $('#seat3').attr('hidden', true);
        } else if ($('#ticketCount').val() == 3) {
            $('#comaSeat2').attr('hidden', false);
            $('#seat2').attr('hidden', false);
            $('#comaSeat3').attr('hidden', false);
            $('#seat3').attr('hidden', false);
        }

    });

    // confirm login SweetAlert2
    $('.submitOrder').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Login first to continue order',
            text: "Cencel if not",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });

    // form validation movie schedule
    $('.submitForm').on('click', function() {
        const date = $('#date').val();
        const price = $('#price').val();
        const time = $('#time').val();
        const studio = $('#studio').val();
        const seat = $('#seat').val();
        const seat2 = $('#seat2').val();
        const seat3 = $('#seat3').val();
        const ticketCount = $('#ticketCount').val();
        if (date == '' || price == '' || time == '') {
            Swal.fire({
                title: 'Set a Schedule',
                text: "please set a schedule first before order Ticket",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke',
            })
            return false;
        }

        if (studio == '') {
            Swal.fire({
                title: 'Set a Seat Studio',
                text: "please set a seat first before order Ticket",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke',
            })
            return false;
        } else if (ticketCount == 1 && seat == '') {
            Swal.fire({
                title: 'Set a Seat Studio',
                text: "please set a seat first before order Ticket",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke',
            })
            return false;
        } else if (ticketCount == 2 && seat2 == '') {
            Swal.fire({
                title: 'Finished choosing a Seat',
                text: "please set a seat first before order Ticket",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke',
            })
            return false;
        } else if (ticketCount == 3 && seat3 == '') {
            Swal.fire({
                title: 'Finished choosing a Seat',
                text: "please set a seat first before order Ticket",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke',
            })
            return false;
        }
    });
</script>

</body>

</html>