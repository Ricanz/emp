$(document).on('click', '#show_detail_report', function () {
    const myNode = document.getElementById("weekly_lecturer_preview");
    myNode.innerHTML = '';

    let date = $(this).attr('data-date');
    let clock_in = $(this).attr('data-clock_in');
    let reports = $(this).attr('data-reports');
    let title = $(this).attr('data-title');
    let data_id = $(this).attr('data-id');
    let approval_id = $(this).attr('data-approval_id');
    let mitra_approval_id = $(this).attr('data-mitra_approval_id');
    let notes = $(this).attr('data-notes');
    let mitra_notes = $(this).attr('data-mitra_notes');
    let attachment = $(this).attr('data-attachment');
    
    $("#logbook_date").text(date)
    $("#logbook_clockin").text(clock_in)
    $("#logbook_reports").val(reports)
    $("#logbook_title").val(title)
    $("#logbook_report_id").val(data_id)
    $("#logbook_approval_id").val(approval_id)
    $("#logbook_mitra_approval_id").val(mitra_approval_id)
    $("#logbook_notes").val(notes)
    $("#logbook_dosen_notes").text(notes)
    $("#logbook_mitra_notes").val(mitra_notes)
    $("#logbook_mitra_notes").text(mitra_notes)

    if(attachment != ''){
        var array = JSON.parse("[" + attachment + "]");
        let total_file = array[0].length
        for (var i = 0; i < total_file; i++) {
            var file_name = array[0][i].file
            var eks = file_name.split('.').pop();
            if(eks == 'docx' || eks == 'pdf'){
                $('#weekly_lecturer_preview').append(`<a href='${file_name}' style='text-decoration: none;' class='pointer' target='_blank'><span>${file_name}</span></a><br>`);
            } else {
                $('#weekly_lecturer_preview').append(`<img class='image-uploaded' src='/${file_name}'><br>`);
            }
        }
    }

    $("#report_detail").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$(document).on('click', '#show_detail_report_weekly', function () {
    const myNode = document.getElementById("lecturer_preview");
    myNode.innerHTML = '';

    let data_id = $(this).attr('data-id');
    let week = $(this).attr('data-week');
    let month = $(this).attr('data-month');
    let reports = $(this).attr('data-reports');
    let approval_id = $(this).attr('data-approval_id');
    let notes = $(this).attr('data-notes');
    let attachment = $(this).attr('data-attachment');
    let mitra_approval_id = $(this).attr('data-mitra_approval_id');
    let mitra_notes = $(this).attr('data-mitra_notes');

    $("#weekly_report_id").val(data_id);
    $("#detail_report_title").text(!week ? 'Monthly Detail Report' : 'Weekly Detail Report');
    $("#weekly_week").text(!week ? month : `Week ${week}`);
    $("#rep").val(reports);
    $("#weekly_approval_id").val(approval_id);
    $("#weekly_mitra_approval_id").val(mitra_approval_id);
    $("#le_weekly_mitra_notes").val(mitra_notes);
    $("#le_weekly_mitra_notes").text(mitra_notes);
    $("#weekly_notes").val(notes);
    $("#weekly_notes").text(notes);
    $("#type").val(!week ? 'monthly' : 'weekly');

    if(attachment != ''){
        var array = JSON.parse("[" + attachment + "]");
        let total_file = array[0].length
        for (var i = 0; i < total_file; i++) {
            var file_name = array[0][i].file
            var eks = file_name.split('.').pop();
            if(eks == 'docx' || eks == 'pdf'){
                $('#lecturer_preview').append(`<a href='/${file_name}' style='text-decoration: none;' class='pointer' target='_blank'><span>${file_name}</span></a><br>`);
            } else {
                $('#lecturer_preview').append(`<img class='image-uploaded' src='/${file_name}'><br>`);
            }
        }
    }

    $("#weekly_report_detail").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$("#add_notes_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/lecturer/notes',
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

$("#add_weekly_notes_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/lecturer/weekly/notes',
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

$("#add_final_notes_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/lecturer/weekly/notes',
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

$(document).on('click', '#lecturer_submit_assignment', function () {
    const myNode = document.getElementById("lecturer_assignment_preview");
    myNode.innerHTML = '';

    let id = $(this).attr('data-id');
    let title = $(this).attr('data-title');
    let description = $(this).attr('data-description');
    let student_title = $(this).attr('data-student_title');
    let approval_id = $(this).attr('data-approval_id');
    let assignment_notes = $(this).attr('data-notes');
    let attachment = $(this).attr('data-attachment');
    let file = $(this).attr('data-file');

    $("#le_assignment_id").val(id)
    $("#assignment_title").text(title)
    $("#assignment_student_title").val(student_title)
    $("#assignment_description").html(description)
    $("#le_assignment_approval_id").val(approval_id)
    $("#assignment_notes").val(assignment_notes)
    $("#download_assignment").attr('href', `/${file}`);
    
    if(attachment != ''){
        var array = JSON.parse("[" + attachment + "]");
        let total_file = array[0].length
        for (var i = 0; i < total_file; i++) {
            var file_name = array[0][i].file
            var eks = file_name.split('.').pop();
            if(eks == 'docx' || eks == 'pdf'){
                $('#lecturer_assignment_preview').append(`<a href='/${file_name}' style='text-decoration: none;' class='pointer' target='_blank'><span>${file_name}</span>`+'<br>');
            } else {
                $('#lecturer_assignment_preview').append(`<img class='image-uploaded' src='/${file_name}'><br>`);
            }
        }
    }

    $("#submit_assignment_notes").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

// $(document).on('submit', '#search_student', function () {
//     alert('test 123')
// });

$("#create_task_approval").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/lecturer/students/assignment',
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

$(document).on('click', '#lecturer_create_assignment', function () {
    // let students = $(this).attr('data-students');
    // // console.log(students);
    // if(students != ''){
    //     var array = JSON.parse("[" + students + "]");
    //     let total_file = array[0].length
    //     for (var i = 0; i < total_file; i++) {
    //         // $('#student_data').append(`<option value="${array[i]['id']}">${array[i]['name']}</option>`);
    //         console.log(array[i].name)
    //     }
    // }

    $("#create_assignment_modal").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$('#lecturer_assignment_image').change(function() {
    var i = $(this).prev('label').clone();
    var file = $('#lecturer_assignment_image')[0].files[0].name;
    $(this).prev('label').text(file);
    $("#label_lecturer_assignment").text(file);
});

$("#lecturer_create_assignment_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/lecturer/assignments',
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