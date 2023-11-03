<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CampusController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FinalReportController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LecturerController as ControllersLecturerController;
use App\Http\Controllers\LogBookController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\QnaController;
use App\Http\Controllers\SchoolarshipController;
use App\Http\Controllers\WeeklyReportController;
use App\Models\WeeklyReport;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/qna', function () {
//     return view('students.qna');
// });
// Route::get('/qna-details', function () {
//     return view('students.qna-details');
// });
// // Route::get('/alumni', function () {
//     return view('students.alumni');
// });

// Route::get('/dashboard', function () {
//     return view('admins.dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/', function () {
    return redirect('login');
});

Route::get('admin/login', [AuthenticatedSessionController::class, 'admin_login'])
                ->name('admin.login');

Route::post('/register-alumni', [AlumniController::class, 'register_alumni']);

// Route::get('/qna', function () {
//     return view('students.qna');
// });
Route::get('/qna', [QnaController::class, 'index']);
Route::get('/qna-form', [QnaController::class, 'create']);
Route::post('/qna', [QnaController::class, 'submit']);
Route::get('/qna-details/{code}', [QnaController::class, 'details']);
Route::post('/qna/reply', [QnaController::class, 'submit_reply']);

Route::get('/test-util', [GeneralController::class, 'test_util']);
// Route::get('/test-del', [AdminController::class, 'delete_attendance']);

Route::middleware(['auth' , 'user'])->group(function () {
    // Student's Routes
    // Route::get('/', [GeneralController::class, 'home'])->name('student');
    Route::get('/home', [GeneralController::class, 'home'])->name('student');

    //Route::get('/job-articles', [ArticleController::class, 'index'])->name('student.articles');
    //Route::get('/job-articles-details/{slug}', [ArticleController::class, 'details'])->name('student.articles.detail');
    //Route::get('/job-articles-create', [ArticleController::class, 'create'])->name('student.articles.create');
    
    //Route::get('/job-vacancy-create', [ArticleController::class, 'create_job_vacancies'])->name('student.articles.create');


    //Route::post('/job-articles/submit', [ArticleController::class, 'submit'])->name('student.articles.submit');
    
    Route::get('/alumni/home', [AlumniController::class, 'index'])->name('alumni');


    Route::get('/info/campus/{page}', [ArticleController::class, 'info_campus'])->name('student_alumni.articles');
    Route::get('/info/campus/detail/{slug}', [ArticleController::class, 'info_campus_detail'])->name('student_alumni.articles.detail');

    Route::post('/info/paging', [ArticleController::class, 'info_campus_paging'])->name('student_alumni.articles.paging');

    Route::get('/alumni', [AlumniController::class, 'alumni'])->name('student_alumni.alumni');

    Route::get('/notification', function () {
        return view('students.notification');
    });

    // Article
    Route::get('/job-articles', [ArticleController::class, 'index'])->name('student_alumni.article');
    Route::get('/job-articles-details/{slug}', [ArticleController::class, 'details'])->name('student_alumni.article.details');
    Route::get('/job-articles-create', [ArticleController::class, 'create'])->name('alumni.article.create');
    
    Route::get('/tips-articles-create', [JobController::class, 'create_tips'])->name('alumni.article.create');
    Route::post('/tips-articles/submit', [JobController::class, 'submit_tips'])->name('alumni.vacancy.submit');

    Route::post('/job-articles/submit', [ArticleController::class, 'submit'])->name('alumni.article.submit');
    Route::post('/job-articles/paging', [ArticleController::class, 'paging'])->name('student_alumni.articles.paging');

    // Schoolarship
    Route::get('/schoolarship', [SchoolarshipController::class, 'index'])->name('student_alumni.schoolarship');
    Route::get('/schoolarship-details/{slug}', [SchoolarshipController::class, 'detail'])->name('student_alumni.schoolarship.details');

    Route::get('/schoolarship-create', [SchoolarshipController::class, 'create'])->name('alumni.schoolarship.create');
    Route::post('/schoolarship/submit', [SchoolarshipController::class, 'submit'])->name('alumni.schoolarship.submit');

    // Job Vacancy
    Route::get('/job-vacancy', [JobController::class, 'vacancy'])->name('student_alumni.vacancy');
    Route::get('/job-vacancy-details/{slug}', [JobController::class, 'details'])->name('student_alumni.vacancy.details');

    Route::get('/job-vacancy-create', [JobController::class, 'create'])->name('alumni.vacancy.create');
    Route::post('/job-vacancy/submit', [JobController::class, 'submit'])->name('alumni.vacancy.submit');

    Route::post('/alumni/change/image', [AlumniController::class, 'update_image'])->name('alumni.update.image');

    Route::get('/log-book', [LogBookController::class, 'index'])->name('student.logbook');
    Route::post('/checkin', [LogBookController::class, 'checkin'])->name('student.logbook');
    Route::post('/checkout', [LogBookController::class, 'checkout'])->name('student.logbook');
    Route::post('/report', [LogBookController::class, 'report'])->name('student.logbook');

    // Weekly Report
    Route::get('/weekly-report', [WeeklyReportController::class, 'weekly'])->name('student.weekly');
    Route::post('/submit_weekly_report', [WeeklyReportController::class, 'submit_weekly_report'])->name('student.weekly');

    // Monthly Report
    Route::get('/monthly-report', [MonthlyReportController::class, 'monthly'])->name('student.monthly');
    Route::post('/submit_monthly_report', [MonthlyReportController::class, 'submit_monthly_report'])->name('student.monthly');

    // Assignment
    Route::get('/assignment', [AssignmentController::class, 'index'])->name('student.assignment');
    Route::post('/assignment', [AssignmentController::class, 'submit'])->name('student.assignment.submit');

    // Final Report
    Route::get('/final-report', [FinalReportController::class, 'final'])->name('student.final');
    Route::post('/final-report/submit', [FinalReportController::class, 'final_submit'])->name('student.final.submit');

    // Lecturer
    Route::get('/lecturer/home', [ControllersLecturerController::class, 'index'])->name('lecturer');
    Route::get('/lecturer/students', [ControllersLecturerController::class, 'students'])->name('lecturer.student');
    Route::get('/lecturer/students/details/{nim}', [ControllersLecturerController::class, 'details'])->name('lecturer.details');
    Route::post('/lecturer/notes', [ControllersLecturerController::class, 'add_notes'])->name('lecturer.add.notes');
    Route::get('/lecturer/students/weekly/{nim}', [ControllersLecturerController::class, 'weekly'])->name('lecturer.weekly');
    Route::post('/lecturer/weekly/notes', [ControllersLecturerController::class, 'add_weekly_notes'])->name('lecturer.weekly.notes');
    Route::get('/lecturer/students/monthly/{nim}', [ControllersLecturerController::class, 'monthly'])->name('lecturer.monthly');
    Route::get('/lecturer/students/final/{nim}', [ControllersLecturerController::class, 'final'])->name('lecturer.final');
    Route::get('/lecturer/students/assignment/{nim}', [ControllersLecturerController::class, 'assignment'])->name('lecturer.assignment');
    Route::post('/lecturer/students/assignment', [ControllersLecturerController::class, 'add_assignment_notes'])->name('lecturer.assignmnet.notes');

    Route::get('/lecturer/assignments', [ControllersLecturerController::class, 'assignment_index'])->name('lecturer.assignments');
    Route::post('/lecturer/assignments', [ControllersLecturerController::class, 'assignment_submit'])->name('lecturer.assignments');

    Route::get('/lecturer/rubrik', [ControllersLecturerController::class, 'rubrik'])->name('lecturer.rubrik');

});

Route::middleware(['auth' , 'user'])->group(function () {
    //Route::middleware(['auth' , 'user'])->get('/', [GeneralController::class, 'home']);

    Route::post('/student/by/mitra',  [StudentController::class, 'student_by_mitra'])->name('admin.student');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard_view'])->name('admin.main.dashboard');
    
    // Route::get('admin/login', [AuthenticatedSessionController::class, 'admin_login'])
    //             ->middleware('user')
    //             ->name('admin.login');

    // Login Page
    Route::get('/admin/login/title', [AdminController::class, 'login_title'])->name('admin.dashboard');
    Route::post('/admin/login/title', [AdminController::class, 'login_title_submit'])->name('admin.dashboard');

    // Final Form
    Route::get('/admin/final/form', [AdminController::class, 'final_form_create'])->name('admin.dashboard');
    Route::post('/admin/final/form', [AdminController::class, 'final_form_submit'])->name('admin.dashboard');

    // Faculty
    Route::get('/admin/faculties', [CampusController::class, 'faculty_view'])->name('admin.dashboard');
    Route::get('/admin/faculties/create', [CampusController::class, 'faculty_create'])->name('admin.dashboard');
    Route::post('/admin/faculties/submit', [CampusController::class, 'faculty_submit'])->name('admin.dashboard');
    Route::get('/admin/faculties/edit/{id}', [CampusController::class, 'faculty_edit'])->name('admin.dashboard');
    Route::post('/admin/faculties/update', [CampusController::class, 'faculty_update'])->name('admin.dashboard');

    // Major
    Route::get('/admin/majors', [CampusController::class, 'major_view'])->name('admin.dashboard');
    Route::get('/admin/majors/create', [CampusController::class, 'major_create'])->name('admin.dashboard');
    Route::post('/admin/majors/submit', [CampusController::class, 'major_submit'])->name('admin.dashboard');
    Route::get('/admin/majors/edit/{id}', [CampusController::class, 'major_edit'])->name('admin.dashboard');
    Route::post('/admin/majors/update', [CampusController::class, 'major_update'])->name('admin.dashboard');

    // Mitra
    Route::get('/admin/mitras', [MitraController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/mitras/create', [MitraController::class, 'create'])->name('admin.dashboard');
    Route::post('/admin/mitras/submit', [MitraController::class, 'submit'])->name('admin.dashboard');
    Route::get('/admin/mitras/edit/{id}/{page}', [MitraController::class, 'edit'])->name('admin.dashboard');
    Route::post('/admin/mitras/update', [MitraController::class, 'update'])->name('admin.dashboard');

    // Student
    Route::get('/admin/student', [StudentController::class, 'index'])->name('admin.student.all');
    // Route::get('/admin/student/detail/{id}', [StudentController::class, 'detail']);
    Route::get('/admin/student/create', [StudentController::class, 'create'])->name('admin.dashboard');
    Route::post('/admin/student/submit', [StudentController::class, 'submit_student'])->name('admin.dashboard');
    Route::post('/admin/student/password/update', [StudentController::class, 'update_password'])->name('admin.dashboard');
    Route::get('/admin/student/edit/{id}/{page}', [StudentController::class, 'edit'])->name('admin.dashboard');
    Route::post('/admin/student/update', [StudentController::class, 'update_student'])->name('admin.dashboard');
    Route::post('/admin/student/absences/data', [StudentController::class, 'absences_data'])->name('admin.dashboard');

    // PIC
    Route::get('/admin/mitra/pic/create/{mitra}', [MitraController::class, 'create_pic'])->name('admin.dashboard');
    Route::post('/admin/mitra/pic/submit', [MitraController::class, 'submit_pic'])->name('admin.dashboard');
    Route::get('/admin/mitra/pic/edit/{id}', [MitraController::class, 'edit_pic'])->name('admin.dashboard');
    Route::post('/admin/mitra/pic/update', [MitraController::class, 'update_pic'])->name('admin.dashboard');
    Route::get('/admin/mitra/manage/pic/{id}', [MitraController::class, 'manage_pic'])->name('admin.dashboard');

    // Lecturer
    Route::get('/admin/lecturer', [LecturerController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/lecturer/create', [LecturerController::class, 'create'])->name('admin.dashboard');
    Route::post('/admin/lecturer/submit', [LecturerController::class, 'submit'])->name('admin.dashboard');
    Route::get('/admin/lecturer/edit/{id}/{page}', [LecturerController::class, 'edit'])->name('admin.dashboard');
    Route::post('/admin/lecturer/update', [LecturerController::class, 'update'])->name('admin.dashboard');

    Route::get('/admin/alumni', [CampusController::class, 'alumni'])->name('admin.dashboard');
    //Route::get('/admin/lecturer/create', [LecturerController::class, 'create'])->name('admin.dashboard');
    // Route::post('/admin/lecturer/submit', [LecturerController::class, 'submit'])->name('admin.dashboard');
    Route::get('/admin/alumni/edit/{id}/{page}', [CampusController::class, 'alumni_detail'])->name('admin.dashboard');

    Route::post('/admin/alumni/update', [CampusController::class, 'alumni_update'])->name('admin.dashboard');
    Route::post('/admin/alumni/update/password', [CampusController::class, 'update_password'])->name('admin.alumni.update.password');
    Route::post('/admin/alumni/post/update', [CampusController::class, 'alumni_post_update'])->name('admin.dashboard');

    // Daily Report
    Route::get('/admin/report/daily', [ReportController::class, 'daily'])->name('admin.dashboard');
    Route::get('/admin/report/daily/detail/{student_id}', [ReportController::class, 'daily_detail'])->name('admin.dashboard');

    // Weekly Report
    Route::get('/admin/report/weekly', [ReportController::class, 'weekly'])->name('admin.dashboard');

    // Final Report
    Route::get('/admin/report/final', [ReportController::class, 'final'])->name('admin.dashboard');

    //  Info
    Route::get('/admin/info/advanced', [AdminController::class, 'advanced'])->name('admin.info');
    Route::get('/admin/info/activity', [AdminController::class, 'activity'])->name('admin.info');
    Route::get('/admin/info/lesson', [AdminController::class, 'lesson'])->name('admin.info');
    Route::get('/admin/info/add/{type}', [AdminController::class, 'info_add'])->name('admin.info');
    Route::get('/admin/info/edit/{id}/{type}', [AdminController::class, 'info_edit'])->name('admin.info.edit');
    Route::post('/admin/info/store', [AdminController::class, 'info_store'])->name('admin.info.store');
    Route::post('/admin/info/update', [AdminController::class, 'info_update'])->name('admin.info.update');

    // Career
    Route::get('/admin/career/{type}', [AdminController::class, 'career'])->name('admin.info');
    Route::get('/admin/career/add/{type}', [AdminController::class, 'career_add'])->name('admin.career');
    Route::get('/admin/career/edit/{id}/{type}', [AdminController::class, 'career_edit'])->name('admin.career.edit');
    Route::post('/admin/career/store', [AdminController::class, 'career_store'])->name('admin.career.store');
    Route::post('/admin/career/update', [AdminController::class, 'career_update'])->name('admin.career.update');
});

Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');
require __DIR__.'/auth.php';
