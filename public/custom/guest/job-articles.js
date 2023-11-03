$(document).on('click' ,'#_to_create_article_' , function(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const type = $("#page-type").val()
    window.location.assign('/job-articles-create?type='+type);
});

$(document).on('click' ,'._to_create_article_' , function(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const type = $("#page-type").val()
    window.location.assign('/job-articles-create?type='+type);
});

$(document).on('click' ,'._to_create_tips_article_' , function(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const type = $("#type_page").val()
    window.location.assign('/tips-articles-create?type='+type);
});

$(document).on('click' ,'._to_create_tips_' , function(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const type = $("#type_page").val()
    window.location.assign('/job-vacancy-create?type='+type);
});


$("#create_article_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    formData.append('description' , $('.ql-editor').html());
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/job-articles/submit',
        dataType: 'JSON',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == 'success') {
                swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Berhasil!",
                    customClass: {
                        confirmButton: "btn-rounded primary"
                    }
                }).then(function () {
                    window.location.reload()
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

$("#create_tips_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    formData.append('description' , $('.ql-editor').html());
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/tips-articles/submit',
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
                    window.location.reload();
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

var loadFile = function(event) {
    var output = document.getElementById('preview_image');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

  var loadFile2 = function(event) {
    var output = document.getElementById('preview_input_file_job_articles');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

