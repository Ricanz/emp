
$(document).on('click' ,'#submit_assignments' , function(){
    const myNode = document.getElementById("assignment_image_preview");
    myNode.innerHTML = '';

    let data_id = $(this).attr('data-id');
    let title = $(this).attr('data-title');
    let description = $(this).attr('data-description');
    let assignment_id = $(this).attr('data-assignment_id');
    let assignment_title = $(this).attr('data-assignment_title');
    let attachment = $(this).attr('data-attachment');
    let task_file = $(this).attr('data-file');
    
    $("#s_assignment_title").text(title)
    $("#s_assignment_description").html(description)
    $("#send_assignment_id").val(assignment_id)
    $("#assignment_title").val(assignment_title)
    $("#assignment_id").val(data_id)
    $("#download_student_assignment").attr('href', `/${task_file}`)

    if(attachment != ''){
        var array = JSON.parse("[" + attachment + "]");
        let total_file = array[0].length
        for (var i = 0; i < total_file; i++) {
            var file_name = array[0][i].file
            var eks = file_name.split('.').pop();
            if(eks == 'docx' || eks == 'pdf'){
                $('#assignment_image_preview').append(`<a href='${file_name}' style='text-decoration: none;' class='pointer' target='_blank'><span>${file_name}</span>`+'<br>');
            } else {
                $('#assignment_image_preview').append(`<img class='image-uploaded' src='${file_name}'><br>`);
            }
        }
    }
    
    $("#submit_assignment").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$('#file-upload-assignment').change(function() {
    var i = $(this).prev('label').clone();
    var file = $('#file-upload-assignment')[0].files[0].name;
    $(this).prev('label').text(file);
    $("#label-assignment").text(file);
});

function assignment_preview_image() {
    const myNode = document.getElementById("assignment_image_preview");
    myNode.innerHTML = '';
    var total_file = document.getElementById("assignment_upload_file").files.length;
    for (var i = 0; i < total_file; i++) {
        var file_name = event.target.files[i].name
        var eks = file_name.split('.').pop();
        if(eks == 'docx' || eks == 'pdf'){
            $('#assignment_image_preview').append(`<span>${file_name}</span>&emsp;`);
        } else {
            $('#assignment_image_preview').append("<img class='image-uploaded' src='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
        }
    }
}

$("#create_assignment_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/assignment',
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