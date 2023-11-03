$(document).on('click' ,'#post_job' , function(){
    window.location.assign('/job-vacancy-create');
});

$("#create_job_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    formData.append('description' , $('.ql-editor').html());
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/job-vacancy/submit',
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
                    window.location.assign('/job-vacancy');
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

function schoolarship_banner() {
    const myNode = document.getElementById("schoolarship_banner_preview");
    myNode.innerHTML = '';
    var total_file = document.getElementById("input_banner_schoolarship").files.length;
    for (var i = 0; i < total_file; i++) {
        var file_name = event.target.files[i].name
        var eks = file_name.split('.').pop();
        if(eks == 'docx' || eks == 'pdf'){
            $('#schoolarship_banner_preview').append(`<span>${file_name}</span><img class='image-uploaded' src='guestAssets/img/dummy-image.svg'><br>`);
        } else {
            $('#schoolarship_banner_preview').append("<img class='image-uploaded' src='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
        }
    }
}