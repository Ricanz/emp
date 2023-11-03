$(document).on('click' ,'#final_report' , function(){
    let data_id = $(this).attr('data-id');
    let report = $(this).attr('data-report');
    let attachment = $(this).attr('data-attachment');

    if(attachment === ''){
        document.getElementById("attachment_download").disabled = true;
    } else {
        document.getElementById("attachment_download").href = attachment;
    }
    
    document.getElementById("report_final").value = report;
    document.getElementById("reports_id").value = data_id;
    
    $("#modal_final_report").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$('#file-upload').change(function() {
    var i = $(this).prev('label').clone();
    var file = $('#file-upload')[0].files[0].name;
    $(this).prev('label').text(file);
});

$("#final_report_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/final-report/submit',
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