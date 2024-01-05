// Datepicker v1.9.0
$('.form-control.dateSchedule').datepicker({
    startDate: '-0d',
    format: 'dd/mm/yyyy',
    clearBtn: true,
    autoclose: true,
    todayHighlight: true,
    toggleActive: true,
});

// Timepicker v2.0.2
mdtimepicker('.timeSchedule', { 
    readOnly: true,
    is24hour: true,
    theme: 'dark',
    hourPadding: true,
    clearBtn: true,
    // maxtime:'now',
    // mintime: 'now',
    events: {
        ready: function() { $('ready', this) },
        shown: function() { $('shown', this) },
        hidden: function() { $('hidden', this) },
        timeChanged: function (data) {
            $('.form-control.timeSchedule').val(data.value);
        }
    }
});
// Timepicker v1.0.0
// $('.timepicker').mdtimepicker({
//     format: 'hh:mm tt',
//     theme: 'indigo',
//     }).on('timechanged', function(e){
//     $('.timeSchedule').val(e.value);
//     $('.timeSchedule').val(e.time);
// });

// edit user image
$('.custom-file-input').on('change', function() {
    // change filename
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);

    // change img
    const base_urlIMG = $('#valImgDefault').val();
    const input = this;
    const url = $(this).val();
    const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
    {
        const reader = new FileReader();
        reader.onload = function (e) {
        $('.img').attr('src', e.target.result);
        }
    reader.readAsDataURL(input.files[0]);
    }
    else
    {
    $('.img').attr('src', base_urlIMG);
    }
});

// delete Data SweetAlert2
$('.deleteData').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Make sure to delete it?',
        text: "Delete will be permanent",
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
            // document.location.href = "<?= base_url('dashboard/auth/logout'); ?>"
            const base_url = $('#logout').val();
            document.location.href = base_url;
        }
    })
});

// Change Studio Is Active
$('.isActiveStudio').on('click', function() {
    const id = $(this).data('id');
    const isAct = $(this).data('ac');

    $.ajax({
        success: function() {
            // alert('success');
            // document.location.href = "<?= base_url('dashboard/bioskop/studioIsActive/'); ?>" + id + '/' + isAct;
            const base_url = $('.isActiveStudio').val();
            document.location.href = base_url+ id + '/' + isAct;
        },
        error: function() {
            alert('error');
        }
    });
});

// Change Seat IsOrdered
$('.orderedSeat').on('click', function() {
    const id = $(this).data('id');
    const ord = $(this).data('ord');

    $.ajax({
        success: function() {
            // alert('success');
            // document.location.href = "<?= base_url('dashboard/bioskop/orderedSeat/'); ?>" + id + '/' + ord;
            const base_url = $('.orderedSeat').val();
            document.location.href = base_url+ id + '/' + ord;
        },
        error: function() {
            alert('error');
        }
    });
});

// Checkbox in modal sub menu add
$('.subMenuActive').on('change', function() {
    this.value = this.checked ? 1 : '0';
    // alert(this.value);
}).change();

// Checkbox in modal admin add
$('.adminActive').on('change', function() {
    this.value = this.checked ? 1 : '0';
    // alert(this.value);
}).change();

// Checkbox in modal customer add
$('.customerActive').on('change', function() {
    this.value = this.checked ? 1 : '0';
    // alert(this.value);
}).change();

// Checkbox in modal studio add
$('.studioIsActive').on('change', function() {
    this.value = this.checked ? 1 : '0';
    // alert(this.value);
}).change();

// Modal studio add
$(document).on('click', '.addStudio', function() {
    $('#studioModalLabel').html('Add New Studio');
    $('.modal-footer button[type=submit]').html('Add');

    const base_url = $('#linkAddStudio').val();
    $('.modal-body form').attr('action', base_url);

    $('.modal-body #id').val('');
    $('.modal-body #name').val('');
    $('.modal-body #information').val('');
    document.getElementsByClassName('form-check')[0].style.visibility = 'initial';
});

// Modal studio edit
$(document).on('click', '.editStudio', function() {
    $('#studioModalLabel').html('Edit Studio');
    $('.modal-footer button[type=submit]').html('Edit');

    const base_url = $('#linkEditStudio').val();
    $('.modal-body form').attr('action', base_url);

    const studio_Id = $(this).data('id');
    const name = $(this).data('name');
    const info = $(this).data('inf');
    $('.modal-body #id').val(studio_Id);
    $('.modal-body #name').val(name);
    $('.modal-body #information').val(info);
    document.getElementsByClassName('form-check')[0].style.visibility = 'hidden';
});

// Modal seat add
$(document).on('click', '.addSeat', function() {
    $('#seatModalLabel').html('Add New Seat');
    $('.modal-footer button[type=submit]').html('Add');

    const base_url = $('#linkAddSeat').val();
    $('.modal-body form').attr('action', base_url);

    $('.modal-body #id').val('');
    $('.modal-body #code_seat').val('');
    $('.modal-body #studio_id').val('');
});

// Modal seat edit
$(document).on('click', '.editSeat', function() {
    $('#seatModalLabel').html('Edit Seat');
    $('.modal-footer button[type=submit]').html('Edit');

    const base_url = $('#linkEditSeat').val();
    $('.modal-body form').attr('action', base_url);

    const seatId = $(this).data('id');
    const codeSeat = $(this).data('cs');
    const studioId = $(this).data('sd');
    $('.modal-body #id').val(seatId);
    $('.modal-body #code_seat').val(codeSeat);
    $('.modal-body #studio_id').val(studioId);
});

// Modal film add
$(document).on('click', '.addFilm', function() {
    $('#filmModalLabel').html('Add New Film');
    $('.modal-footer button[type=submit]').html('Add');
    const base_url = $('#linkAddfilm').val();
    $('.modal-body form').attr('action', base_url);
    $('.modal-body #id').val('');
    $('.modal-body #title').val('');
    $('.modal-body #category').val('');
    $('.modal-body #description').val('');
    $('.custom-file-label').addClass("selected").html('Choose file');
    $('.custom-file-input').attr('required', true);

    const base_urlIMG = $('#valImgDefault').val();
    $('.modal-body .img').attr('src', base_urlIMG);
});

// Modal film edit
$(document).on('click', '.editFilm', function() {
    $('#filmModalLabel').html('Edit Film');
    $('.modal-footer button[type=submit]').html('Edit');
    const filmId = $(this).data('id');
    const base_url = $('#linkEditfilm').val();
    $('.modal-body form').attr('action', base_url + filmId);
    const title = $(this).data('t');
    const category = $(this).data('c');
    const des  = $(this).data('d');
    const img = $(this).data('i');
    $('.modal-body #id').val(filmId);
    $('.modal-body #title').val(title);
    $('.modal-body #category').val(category);
    $('.modal-body #description').val(des);
    $('.custom-file-label').addClass("selected").html(img);
    $('.custom-file-input').attr('required', false);

    const base_urlIMG = $('#valImg').val();
    $('.modal-body .img').attr('src', base_urlIMG + img);
});

// Add schedule
$('.addSchedule').on('click', function() {
    $('#scheduleModalLabel').html('Add new Schedule');
    $('.modal-footer button[type=submit]').html('Add');
    const addlink = $('.linkAdd').val();
    $('.modal-body form').attr('action', addlink);
    $('.modal-body #price').get(0).type = 'number';

    $('.modal-body #date').val('');
    $('.modal-body #time').val('');
    $('.modal-body #price').val('');
    $('.modal-body #message').val('');
    $('.modal-body #id').val('');
});

// Edit schedule
$('.editSchedule').on('click', function() {
    $('#scheduleModalLabel').html('Edit Schedule');
    $('.modal-footer button[type=submit]').html('Edit');
    const editLink = $('.linkEdit').val();
    $('.modal-body form').attr('action', editLink);

    const id = $(this).data('id');
    const base_url = $('.linkGetSchedule').val();
    $('.modal-body #price').get(0).type = 'number';
    $.ajax({
        url: base_url,
        data: {id : id},
        type: 'POST',
        dataType: 'json',
        cache: false,
        context: this,
        success: function(data) {
            $('.modal-body #date').val(data.date);
            $('.modal-body #time').val(data.time);
            $('.modal-body #price').val(data.price);
            $('.modal-body #message').val(data.message);
            $('.modal-body #id').val(data.id);
        },
        error: function() {
            alert('error');
        }
    });
});
