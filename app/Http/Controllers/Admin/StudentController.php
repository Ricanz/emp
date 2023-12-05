<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Resources\AbsencesResource;
use App\Models\Attendance;
use App\Models\FinalReport;
use App\Models\Major;
use App\Models\Mentor;
use App\Models\Mitra;
use App\Models\MonthlyReport;
use App\Models\Student;
use App\Models\StudentReport;
use App\Models\Task;
use App\Models\User;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $data = Student::with('major')
            ->with('mitra')
            ->with('dosen_pa')
            ->with('dosen_pl')
            ->where('status', '!=', 'deleted')
            ->orderBy('name')->get();
        // dd($data);
        return view('admins.student.index', compact('data'));
    }

    public function create()
    {
        $major = Major::where('status', 'active')->orderBy('name')->get();
        $mitra = Mitra::where('status', 'active')->get();
        $dpa = Mentor::where('role', 'lecturer')->where('status', 'active')->where('jenis', 'dpa')->get();
        $dpl = Mentor::where('role', 'lecturer')->where('status', 'active')->where('jenis', 'dpl')->get();
        return view('admins.student.create', compact('major', 'mitra', 'dpa', 'dpl'));
    }

    public function submit_student(Request $request)
    {
        // $this->generate_attendances($request->start_date, $request->end_date, 50);
        // $this->generate_report($request->start_date, $request->end_date, 1, $request->mitra_id);
        // dd("stop");

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'email' => 'required',
            'nim' => 'required',
            'nim' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'student',
                'password' => Hash::make('pass.123'),
            ]);
            if ($user) {
                if ($request->image != null) {
                    $extention = $request->image->extension();
                    $file_name = time() . '.' . $extention;
                    $txt = "storage/mentor/" . $file_name;
                    $request->image->storeAs('public/mentor', $file_name);
                    $image = $txt;
                } else {
                    $image = null;
                }
                $check_deleted_nim = Student::where('nim', $request->nim)->where('status', 'deleted')->first();
                if($check_deleted_nim){
                    $check_deleted_nim->nim = $check_deleted_nim->nim.'-d';
                    $check_deleted_nim->save();
                }
                $student = Student::create([
                    'nim' => $request->nim,
                    'name' => $request->name,
                    'email' => $request->email,
                    'major_id' => $request->major_id,
                    'mitra_id' => $request->mitra_id,
                    'user_id' => $user->id,
                    'image' => $image,
                    'year' => $request->tahun,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'phone' => $request->no_telp,
                    'gender' => $request->gender,
                    'dpa' => $request->dpa,
                    'dpl' => $request->dpl,
                    // 'is_alumni' => $request->is_alumni == 'true' ? true : false,
                    // 'history' => $request->history,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);

                if ($student) {
                    $this->generate_report($request->start_date, $request->end_date, $student->id, $request->mitra_id);
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module' => 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status' => false, 'message' => ['Gagal Tambah Mahasiswa, Perhatikan Email atau Data Lainnya']]);
        }

        return json_encode(['status' => true, 'message' => "Success"]);
    }

    public function edit($id , $page){
       
        if($page == 'profile'){
        return $this->profile($id , $page);
       }
       if($page == 'password'){
        return $this->password_page($id , $page);
       }
       if($page == 'tasks'){
        return $this->tasks($id , $page);
       }
       if($page == 'absences'){
        return $this->absences($id , $page);
       }
       if($page == 'daily-reports'){
        return $this->daily_reports($id , $page);
       }
       if($page == 'weekly-reports'){
        return $this->weekly_reports($id , $page);
       }
       if($page == 'monthly-reports'){
        return $this->monthly_reports($id , $page);
       }
       if($page == 'final-reports'){
        return $this->final_reports($id , $page);
       }
    }

    public function password_page($id , $page){
        return view('admins.student.profile.password', compact('id' , 'page'));
    }

    public function update_password(Request $request){
        $validation = Validator::make($request->all(), [
            'password' => 'required|min:6|max:50|confirmed',
            'user_id' => 'required'
            // 'password_confirmation' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $student = Student::findOrFail($request->user_id);
            if(!$student){
                return json_encode(['status'=> false, 'message'=> "Mahasiswa tidak ditemukan"]); 
            }
            $user = User::findOrFail($student->user_id);
            $user->password = Hash::make($request->password);
            $user->updated_at = date('Y-m-d H:i:s');
            
            if(!$user->save()){
                return json_encode(['status'=> false, 'message'=> ['Terjadi kesalahan, tidak dapat mengubah password.']]);
            }
            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status'=> false, 'message'=> ['Terjadi kesalahan, tidak dapat mengubah password.']]);
        }

        return json_encode(['status'=> true, 'message'=> "Success"]);
    }


    public function tasks($id , $page ){
        $tasks =    Task::where('student_id' , $id)
                    ->with('student_task')
                    ->orderBy('id' , "ASC")
                    ->get();
        $student = Student::findOrFail($id);
        return view('admins.student.profile.tasks', compact('id' , 'page','tasks' , 'student'));
    }

    public function daily_reports($id , $page ){
        $reports =  StudentReport::where('student_id' , $id)
                    ->with('attendance')
                    ->with('file')
                    ->orderBy('intern_date' , "ASC")
                    ->get();
        $student = Student::findOrFail($id);
        return view('admins.student.profile.reports', compact('id' , 'page','reports' , 'student'));
    }

    public function weekly_reports($id , $page ){
        $reports =  WeeklyReport::where('student_id' , $id)
                    ->with('attachment')
                    ->orderBy('id' , "ASC")
                    ->get();
        $student = Student::findOrFail($id);
        return view('admins.student.profile.weekly_reports', compact('id' , 'page','reports' , 'student'));
    }

    public function monthly_reports($id , $page ){
        $reports =  MonthlyReport::where('student_id' , $id)
                    ->with('attachment')
                    ->orderBy('id' , "ASC")
                    ->get();
        $student = Student::findOrFail($id);
        return view('admins.student.profile.monthly_reports', compact('id' , 'page','reports' , 'student'));
    }

    public function final_reports($id , $page ){
        $reports =  FinalReport::where('student_id' , $id)
                    ->orderBy('id' , "ASC")
                    ->get();
        $student = Student::findOrFail($id);
        return view('admins.student.profile.final_reports', compact('id' , 'page','reports' , 'student'));
    }
    
    public function absences($id , $page){
        $student = Student::findOrFail($id);
        return view('admins.student.profile.absences', compact('id' , 'page' , 'student'));
    }

    public function absences_data(Request $request){
       $attendances = StudentReport::where('student_id' , $request->user_id)->with('attendance')->orderBy('intern_date' , "ASC")->get();
       $datas = [];
       foreach($attendances as $attendance){
        if($attendance->attendance == null){
            if(strtotime($attendance->intern_date) < strtotime(date('Y-m-d'))){
                $datas[] = array(
                    'title' => 'Absen',
                    'start' => date('Y-m-d' , strtotime($attendance->intern_date)),
                    'end'=> date('Y-m-d' , strtotime($attendance->intern_date)),
                    'className'=> 'bg'
                );
            }
        }else{
            $datas[] = array(
                'title' => $this->check_absence($attendance->attendance , 'in'),
                'start' => date('Y-m-d' , strtotime($attendance->intern_date)),
                'end'=> date('Y-m-d' , strtotime($attendance->intern_date)),
                'className'=> 'bg'
            );
            $datas[] = array(
                'title' => $this->check_absence($attendance->attendance  , 'out'),
                'start' => date('Y-m-d' , strtotime($attendance->intern_date)),
                'end'=> date('Y-m-d' , strtotime($attendance->intern_date)),
                'className'=> 'bg'
            );
        }
       }
       if($attendances){
            return response()->json(['status' => 'success' , 'data' => $datas]);
       }
       return [];
    }

    public function check_absence($attendace , $status){
        if($status == 'in'){
            return 'In : '.date('H:i' , strtotime($attendace->checkin));
        }else{
            return 'Out : '.date('H:i' , strtotime($attendace->checkout));
        }
    }

    public function profile($id , $page){
        $major = Major::all();
        $mitras = Mitra::where('status', 'active')->get();
        $mitra = Mitra::where('status', 'active')->get();
        $dpa = Mentor::where('role', 'lecturer')->where('status', 'active')->where('jenis', 'dpa')->get();
        $dpl = Mentor::where('role', 'lecturer')->where('status', 'active')->where('jenis', 'dpl')->get();
        $student = Student::with('major')
                            ->with('mitra')
                            ->with('dosen_pa')
                            ->with('dosen_pl')
                            ->where('id', $id)
                            ->first();
        return view('admins.student.edit', compact('student', 'major', 'mitra', 'dpa', 'dpl' , 'page'));
    }

    
    public function update_student(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }

        $now = Carbon::now();
        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $student = Student::findOrFail($request->id);

            if ($student) {
                if ($request->image != null) {
                    $image = Utils::save_image_file($request->image);
                } else {
                    $image = $student->image;
                }
                $start_date = $request->start_date != null ? $request->start_date : $student->start_date;
                $end_date = $request->end_date != null ? $request->end_date : $student->end_date;

                if ($request->mitra_id != $student->mitra_id) {
                    $this->generate_report($start_date, $end_date, $student->id, $request->mitra_id);
                }
                $student->nim = $request->nim;
                $student->name = $request->name;
                $student->email = $request->email;
                $student->image = $image;
                $student->major_id = $request->major_id;
                $student->mitra_id = $request->mitra_id;
                $student->dpa = $request->dpa;
                $student->dpl = $request->dpl;
                // $student->year = $request->tahun;
                $student->start_date = $start_date;
                $student->end_date = $end_date;
                $student->phone = $request->no_telp;
                $student->gender = $request->gender;
                $student->status = $request->status;
                // $student->is_alumni = $request->is_alumni == 'true' ? true : false;
                // $student->history = $request->history;
                $student->updated_at = $now;
                $student->save();
            }

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module' => 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return false;
        }

        return json_encode(['status' => true, 'message' => "Success"]);
    }

    public function generate_report($start_date, $end_date, $student_id, $mitra_id)
    {

        $start = new \Carbon\Carbon($start_date);
        $end = new \Carbon\Carbon($end_date);
        $interval = $start->diff($end);
        $days = $interval->days;
        $now = Carbon::now();

        $week = 1;
        $add_day = 0;
        $datos = new DateTime($start_date);
        $first_month = $datos->format('F');
        
        $month_report = MonthlyReport::create([
            'student_id' => $student_id,
            'month' => $first_month,
            'type' => 'monthly',
            'month_date' => $start_date
        ]);
        $week_report = WeeklyReport::create([
            'student_id' => $student_id,
            'week' => $week,
            'week_date' => $start_date,
            'type' => 'weekly',
            'month_id' => $month_report->id
        ]);
        $student_report = StudentReport::create([
            'student_id' => $student_id,
            // 'mitra_id' => $mitra_id,
            'intern_date' => $start,
            'week_id' => $week_report->id,
            'type' => 'daily'
        ]);
        $att = Attendance::create([
            'student_id' => $student_id,
            'report_id' => $student_report->id,
            'checkin' => $start,
            'checkout' => $start,
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $week++;


        for ($i = 0; $i < $days; $i++) {
            $date = $start->addDays(1);
            $d = new DateTime($date);
            $day = $d->format('l');
            $month = $d->format('F');

            if ($day == "Sunday") {
                if($week == 1){
                    continue;
                }else{
                    if($first_month != $month){
                        $month_report = MonthlyReport::create([
                            'student_id' => $student_id,
                            // 'mitra_id' => $mitra_id,
                            'month' => $month,
                            'type' => 'monthly',
                            'month_date' => $date
                        ]);
                        $first_month = $month;
                    }
                    $week_report = WeeklyReport::create([
                        'student_id' => $student_id,
                        // 'mitra_id' => $mitra_id,
                        'week' => $week++,
                        'week_date' => $date,
                        'type' => 'weekly',
                        'month_id' => $month_report->id
                    ]);
                }
            }
            $student_report = StudentReport::create([
                'student_id' => $student_id,
                // 'mitra_id' => $mitra_id,
                'intern_date' => $date,
                'week_id' => $week_report->id,
                'type' => 'daily'
            ]);
            if($start < $now){
                Attendance::create([
                    'student_id' => $student_id,
                    'report_id' => $student_report->id,
                    'checkin' => $start,
                    'checkout' => $start,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
        }

        return true;
    }

    public function generate_attendances($start_date, $end_date, $student_id){
        // dd($start_date, $end_date, $student_id);
        $start = new \Carbon\Carbon($start_date);
        $end = new \Carbon\Carbon($end_date);
        $interval = $start->diff($end);
        $days = $interval->days;
        $now = Carbon::now();

        for ($i = 0; $i < $days; $i++) {
            if($start != $now){
                Attendance::create([
                    'student_id' => $student_id,
                    'checkin' => $start,
                    'checkout' => $start,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
            $start->addDay(1);
        }
        
    }

    public function student_by_mitra(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
        
        $students = Student::where('mitra_id' , $request->id)
        ->where('status' , 'active')
        ->paginate();
        print_r($students->toArray());
        // return response()->json($students);
        if($students){
            return response()->json(
                array(
                    "draw" => intval($draw),
                    "iTotalRecords" => array_key_exists('total' ,$students->toArray()) ?  $students->toArray()['total'] : $students->toArray()['to'],
                    "iTotalDisplayRecords" => $students->toArray()['to'],
                    "aaData" =>  $students->toArray()['data']
                )
            );
        }
        return response()->json(['status' => 'success' , 'data' => []]);
    }

    public function all_student(Request $request){
        $students = Student::where('mitra_id' , $request->id)->where('status' , 'active')->get();
        
        if($students){
            return response()->json(['status' => 'success' , 'data' => $students]);
        }

        return response()->json(['status' => 'success' , 'data' => []]);
    }
}
