$("#create_alumni_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/register-alumni',
        dataType: 'JSON',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status === true) {
                swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Berhasil!",
                    customClass: {
                        confirmButton: "btn-rounded primary"
                    }
                }).then(function () {
                    window.location.assign('/login');
                });
            } else {
                var values = '';
                jQuery.each(data.message, function (key, value) {
                    values += value + "<br>";
                });

                swal.fire({
                    html: values,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn-rounded danger"
                    }
                }).then(function () { });
            }
        }
    });
});

$("#alumni_filter").on("change", function (event) {
    let filter = $(this).val();
    window.location.assign(`/alumni?filter=${filter}`);
});

$("#alumni_year_filter").on("change", function (event) {
    let filter = $(this).val();
    window.location.assign(`/alumni?year=${filter}`);
});

$("#alumni_name_filter").on("submit", function (event) {
    let filter = $("#alumni_name").val();
    window.location.assign(`/alumni?alumni_name=${filter}`);
});

$(document).on('click', '#btn_preview_img', function () {
    $("#modal_preview_img").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$(document).on('click' ,'#show_detail_alumni' , function(){
    let history = $(this).attr('data-history');
    let alumni_name = $(this).attr('data-name');
    let alumni_nim = $(this).attr('data-nim');
    let alumni_image = $(this).attr('data-image');

    $("#alumni_riwayat").text(history);
    $("#alumni_name").text(alumni_name);
    $("#alumni_nim").text(alumni_nim);
    $("#alumni_image").attr('src', alumni_image);

    $("#modal_alumni").addClass('show');
    $("#overlay").addClass('show');
    $("body").addClass('overflow-hidden');

})

