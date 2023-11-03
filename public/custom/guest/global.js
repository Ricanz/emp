var queryString
queryString = window.location.search;

var urlParams 
urlParams= new URLSearchParams(queryString);

var today 
today = new Date();
var current_month 
current_month = today.toLocaleString('default', { month: 'long' });

$(document).on('click', '#overlay', function () {
    $(".modal").removeClass('show');
});

$(document).on('click', '.close-modal', function () {
    $(".modal").removeClass('show');
    $("body").removeClass('overflow-hidden');
    $("#overlay").removeClass('show');
});

$(document).on('click', '#view_assignment', function () {
    $("#view_assignment").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$(document).on('click', '#weekly_report', function () {
    $("#modal_weekly_report").addClass('show');
    $("body").addClass('overflow-hidden');
    $("#overlay").addClass('show');
});

$(document).on('click', '#back_home', function () {
    window.location.assign('/home');
});

$(document).on('click', '#_to_daily_report_', function () {
    window.location.assign('/log-book');
});

$(document).on('click', '#_to_weekly_report_', function () {
    window.location.assign('/weekly-report?week=1&month='+current_month);
});

$(document).on('click', '#_to_monthly_report_', function () {
    window.location.assign('/monthly-report?month='+current_month);
});

$(document).on('click', '#_to_final_report_', function () {
    window.location.assign('/final-report');
});

$(document).on('click', '#_to_assignment_', function () {
    window.location.assign('/assignment');
});
$(document).on('click', '#_to_qna_', function () {
    window.location.assign('/qna');
});

$(document).on('click', '#_to_students_report_', function () {
    window.location.assign('/lecturer/students');
});

$(document).on('click' ,'#side_profile' , function(){
    $(".pop-over").removeClass('slide');
    $("#profile_menu").toggleClass('slide');
    $("#overlay").toggleClass('slide');
    $("body").toggleClass('overflow-hidden');
});

$(document).on('click', '#side_report', function() {
    $(".pop-over").removeClass('slide');
    $("#report_menu").toggleClass('slide');
    $("#overlay").toggleClass('slide');
    $("body").toggleClass('overflow-hidden');
});

$(document).on('click', '#overlay', function () {
    $(this).removeClass('slide')
    $(".modal").removeClass('show');
    $(".side-section").removeClass('slide');
});

function display_c() {
    var refresh = 1000;
    mytime = setTimeout('display_ct()', refresh)
}

function display_ct() {
    const weekday = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    var x = new Date()
    var day = weekday[x.getDay()];
    var date = x.getDate();
    var month = monthNames[x.getMonth()];
    var year = x.getFullYear();

    var hours = x.getHours() < 10 ? ('0' + x.getHours()) : x.getHours();
    var minutes = x.getMinutes() < 10 ? ('0' + x.getMinutes()) : x.getMinutes();
    var seconds = x.getSeconds() < 10 ? ('0' + x.getSeconds()) : x.getSeconds();

    var date = day + ", " + date + " " + month + " " + year;
    var time = hours + ":" + minutes + ":" + seconds + ' WIB';

    if (document.getElementById('date')) {
        document.getElementById('date').innerHTML = date;
    }
    if (document.getElementById('get_date')) {
        document.getElementById('get_date').innerHTML = date;
    }
    if (document.getElementById('getDate')) {
        document.getElementById('getDate').innerHTML = date;
    }
    if (document.getElementById('time')) {
        document.getElementById('time').innerHTML = time;
    }
    if (document.getElementById('get_time')) {
        document.getElementById('get_time').innerHTML = time;
    }
    if (document.getElementById('getTime')) {
        document.getElementById('getTime').innerHTML = time;
    }

    display_c();
}

function readURL(input) {
    console.log(input)
    if (input.files && input.files[0]) {
        let id = input.id
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview_' + id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function preview_image() {
    const myNode = document.getElementById("image_preview");
    myNode.innerHTML = '';
    var total_file = document.getElementById("upload_file").files.length;
    for (var i = 0; i < total_file; i++) {
        var file_name = event.target.files[i].name
        var eks = file_name.split('.').pop();
        if(eks == 'docx' || eks == 'pdf'){
            $('#image_preview').append(`<span>${file_name}</span>&emsp;`);
        } else {
            $('#image_preview').append("<img class='image-uploaded' src='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
        }
    }
}

$('#file-upload').change(function () {
    var i = $(this).prev('label').clone();
    var file = $('#file-upload')[0].files[0].name;
    $(this).prev('label').text(file);
});

$(document).on('click', '#forget_password', function () {
    $("#tooltip_pwd").addClass('show');
});

// $('.article-description').html(function(i,h){
//     return h.replace(/&nbsp;/g,'');
// });