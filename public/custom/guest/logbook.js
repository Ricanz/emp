const logbook_month = urlParams.get('month')

if(logbook_month){
    $('#month_filter').val(logbook_month)
}

$(document).on('click', '#clock_in', function () {
    $("#modal_clock_in").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$(document).on('click', '#clock_out', function () {
    $("#modal_clock_out").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$(document).on('click', '#add_activity', function () {
    let date = $(this).attr('data-date');
    let clock_in = $(this).attr('data-clock_in');

    $("#clock_in").html(clock_in)
    $("#daily_date").html(date)

    $("#modal_activity").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$("#month_filter").on("change", function (event) {
    let month = $(this).val();
    window.location.assign(`/log-book?month=${month}`);
});

$(document).on('click' ,'#show_activity' , function(){
    
    const myNode = document.getElementById("image_preview");
    myNode.innerHTML = '';

    let data_id = $(this).attr('data-id');
    let reports = $(this).attr('data-reports');
    let title = $(this).attr('data-title');
    let attachment = $(this).attr('data-attachment');
    let date = $(this).attr('data-date');
    let clock_in = $(this).attr('data-clock_in');
    let dosen_approval = $(this).attr('data-dosen_approval');
    let mitra_approval = $(this).attr('data-mitra_approval');
    
    $("#daily_date").html(date)
    $("#clock_in").html(clock_in)
    $("#modal_title").html("Ubah Activity")
    $("#modal_button").html("Ubah")
    $("#report").val(reports)
    $("#title").val(title)
    $("#report_id").val(data_id)
    // $("#preview_input_file_activity").attr('src', attachment != '' ? attachment : 'guestAssets/img/dummy-image.svg')

    if(attachment != ''){
        var array = JSON.parse("[" + attachment + "]");
        let total_file = array[0].length
        for (var i = 0; i < total_file; i++) {
            var file_name = array[0][i].file
            var eks = file_name.split('.').pop();
            if(eks == 'docx' || eks == 'pdf'){
                $('#image_preview').append(`<a href='${file_name}' style='text-decoration: none;' class='pointer' target='_blank'><span>${file_name}</span>`+'<br>');
            } else {
                $('#image_preview').append(`<img class='image-uploaded' src='${file_name}'><br>`);
            }
        }
    }
    // console.log(dosen_approval);

    if(dosen_approval != ''){
        var approval = JSON.parse("[" + dosen_approval + "]");
        $('#dosen_text').removeClass('d-none');
        $('#dosen_input').removeClass('d-none');
        $('#lecturer_approval').val(approval[0].notes)
    }

    if(mitra_approval != ''){
        var mitra = JSON.parse("[" + mitra_approval + "]");
        $('#mitra_text').removeClass('d-none');
        $('#mitra_input').removeClass('d-none');
        $('#mitra_approval').val(mitra[0].notes);
    }

    $("#modal_activity").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$("#clock_in_form").on("click", function (event) {

    event.preventDefault();
   // if (!navigator.geolocation)
   // return alert("Geolocation is not supported.");

  // jika browser support maka fungsi ini akan dijalankan
   // navigator.geolocation.getCurrentPosition((position) => {
      //  $("#latitude_clockin").val(position.coords.latitude);
      //  $("#longitude_clockin").val(position.coords.longitude);
        var token = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData(this);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': token },
            type: 'POST',
            data: formData,
            url: '/checkin',
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
                        confirmButtonText: "Berhasil clock in!",
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
        
   // });

    
});

$("#clock_out_form").on("click", function (event) {
    event.preventDefault();
   // if (!navigator.geolocation)
  //  return alert("Geolocation is not supported.");
  // jika browser support maka fungsi ini akan dijalankan
   // navigator.geolocation.getCurrentPosition((position) => {
   //     $("#latitude_clockout").val(position.coords.latitude);
   //    $("#longitude_clockout").val(position.coords.longitude);
        var token = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData(this);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': token },
            type: 'POST',
            data: formData,
            url: '/checkout',
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
                        confirmButtonText: "Berhasil clock out!",
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
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () { });
                }
            }
        });
    //});
});

$("#create_activity_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/report',
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
                    confirmButtonText: "Berhasil",
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
