const month = urlParams.get('month')
const week = urlParams.get('week')

if(month){
    $('#weekly_month_text').text(month)
    $('#weekly_month_text2').text(month)
    $('#_weekly_month_text').text(month)
}

$(document).on('click' ,'#weekly_report' , function(){
    const myNode = document.getElementById("weekly_image_preview");
    myNode.innerHTML = '';
    let data_id = $(this).attr('data-id');
    let report = $(this).attr('data-report');
    let range = $(this).attr('data-range');
    let week = $(this).attr('data-week');
    let attachment = $(this).attr('data-attachments');
    let weekly_dosen_approval = $(this).attr('data-dosen_approval');
    let weekly_mitra_approval = $(this).attr('data-mitra_approval');

    $("#modal_weekly_report").attr('data-id', data_id);
    $("#modal_week_id").val(data_id)
    $("#weekly_reports").val(report)
    $("#week_text").html('Week '+ week)
    $("#range_text").html(range)
    // $("#preview_input_file_weekly").attr('src', attachments === '' ? '/guestAssets/img/dummy-image.svg' : attachments)
    if(attachment != ''){
        var array = JSON.parse("[" + attachment + "]");
        let total_file = array[0].length
        for (var i = 0; i < total_file; i++) {
            var file_name = array[0][i].file
            var eks = file_name.split('.').pop();
            if(eks == 'docx' || eks == 'pdf'){
                $('#weekly_image_preview').append(`<a href='${file_name}' style='text-decoration: none;' class='pointer' target='_blank'><span>${file_name}</span></a><br>`);
            } else {
                $('#weekly_image_preview').append(`<img class='image-uploaded' src='${file_name}'><br>`);
            }
        }
    }

    if(weekly_dosen_approval != ''){
        var approval = JSON.parse("[" + weekly_dosen_approval + "]");
        $('#weekly_lecturer_text').removeClass('d-none');
        $('#weekly_lecturer_input').removeClass('d-none');
        $('#weekly_lecturer_notes').val(approval[0].notes)
    }

    if(weekly_mitra_approval != ''){
        var mitra_approval = JSON.parse("[" + weekly_mitra_approval + "]");
        $('#weekly_mitra_text').removeClass('d-none');
        $('#weekly_mitra_input').removeClass('d-none');
        $('#weekly_mitra_notes').val(mitra_approval[0].notes)
    }

    $("#modal_weekly_report").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$("#weekly_month_filter").on("change", function (event) {
    let item = $(this).val();
    var obj = JSON.parse(item);
    
    window.location.assign(`/weekly-report?week=${obj.week}&month=${obj.month}`);
});

function weekly_preview_image() {
    const myNode = document.getElementById("weekly_image_preview");
    myNode.innerHTML = '';
    var total_file = document.getElementById("preview_input_file_weekly").files.length;
    for (var i = 0; i < total_file; i++) {
        var file_name = event.target.files[i].name
        var eks = file_name.split('.').pop();
        if(eks == 'docx' || eks == 'pdf'){
            $('#weekly_image_preview').append(`<span>${file_name}</span><br>`);
        } else {
            $('#weekly_image_preview').append("<img class='image-uploaded' src='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
        }
    }
}

$("#weekly_report_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/submit_weekly_report',
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
