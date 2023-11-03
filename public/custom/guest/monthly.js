$(document).on('click' ,'#monthly_report' , function(){
    const myNode = document.getElementById("monthly_image_preview");
    myNode.innerHTML = '';

    let month_id = $(this).attr('data-id');
    let report = $(this).attr('data-report');
    let month = $(this).attr('data-month');
    let attachment = $(this).attr('data-attachments');
    let monthly_lecturer_approval = $(this).attr('data-dosen_approval')
    let monthly_mitra_approval = $(this).attr('data-mitra_approval')

    $("#month_id").val(month_id);
    $("#monthly_reports").val(report);
    // $("#preview_input_file_monthly").attr('src', attachments == '' ? 'guestAssets/img/dummy-image.svg' : attachments)
    $("#month_text").html(month)
    if(attachment != ''){
        var array = JSON.parse("[" + attachment + "]");
        let total_file = array[0].length
        for (var i = 0; i < total_file; i++) {
            var file_name = array[0][i].file
            var eks = file_name.split('.').pop();
            if(eks == 'docx' || eks == 'pdf'){
                $('#monthly_image_preview').append(`<a href='${file_name}' style='text-decoration: none;' class='pointer' target='_blank'><span>${file_name}</span><img class='image-uploaded' src='guestAssets/img/dummy-image.svg'></a><br>`);
            } else {
                $('#monthly_image_preview').append(`<img class='image-uploaded' src='${file_name}'><br>`);
            }
        }
    }

    if(monthly_lecturer_approval != ''){
        var approval = JSON.parse("[" + monthly_lecturer_approval + "]");
        $('#monthly_lecturer_text').removeClass('d-none');
        $('#monthly_lecturer_input').removeClass('d-none');
        $('#monthly_lecturer_approval').val(approval[0].notes)
    }

    if(monthly_mitra_approval != ''){
        var mitra_approval = JSON.parse("[" + monthly_mitra_approval + "]");
        $('#monthly_mitra_text').removeClass('d-none');
        $('#monthly_mitra_input').removeClass('d-none');
        $('#monthly_mitra_approval').val(mitra_approval[0].notes)
    }

    $("#modal_monthly_report").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});


$(document).on('click', '.close-modal-monthly', function () {
    $('#monthly_lecturer_text').addClass('d-none');
    $('#monthly_lecturer_input').addClass('d-none');

    $('#monthly_mitra_text').addClass('d-none');
    $('#monthly_mitra_input').addClass('d-none');

    $(".modal").removeClass('show');
    $("body").removeClass('overflow-hidden');
});

$("#monthly_filter").on("change", function (event) {
    let item = $(this).val();
    
    window.location.assign(`monthly-report?month=${item}`);
});

function monthly_preview_image() {
    const myNode = document.getElementById("monthly_image_preview");
    myNode.innerHTML = '';
    var total_file = document.getElementById("input_file_monthly").files.length;
    for (var i = 0; i < total_file; i++) {
        var file_name = event.target.files[i].name
        var eks = file_name.split('.').pop();
        if(eks == 'docx' || eks == 'pdf'){
            $('#monthly_image_preview').append(`<span>${file_name}</span><br>`);
        } else {
            $('#monthly_image_preview').append("<img class='image-uploaded' src='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
        }
    }
}

$("#monthly_report_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/submit_monthly_report',
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
                    confirmButtonText: "Berhasil membuat laporan bulanan!",
                    customClass: {
                        confirmButton: "btn-rounded primary"
                    }
                }).then(function () {
                    location.reload()
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