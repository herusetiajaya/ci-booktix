// Image edit user
$('.custom-file-input').on('change', function() {
    const fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
}).change();

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
    $('.modal-body #studio_id').val('defaultSelect');
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