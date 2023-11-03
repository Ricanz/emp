<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\ApprovalReport;
use App\Models\ApprovalTask;
use App\Models\FinalForm;
use App\Models\FinalReport;
use App\Models\FinalReportAttachment;
use App\Models\Mentor;
use App\Models\MonthlyReport;
use App\Models\Pic;
use App\Models\PicApproval;
use App\Models\Rubrik;
use App\Models\Student;
use App\Models\StudentReport;
use App\Models\StudentTask;
use App\Models\Task;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LecturerController extends Controller
{
    public function index(){
        $user = Auth::user();
        $lecturer = Mentor::where('user_id', $user->id)->first();
        if(!$lecturer){
            $lecturer = Pic::where('user_id', $user->id)->first();
        }
        if($lecturer->status != 'active'){
            return redirect()->route('logout');
        }
        return view('students.lecturers.index', compact('lecturer'));
    }

    public function students(){
        $user = Auth::user();
        $name = '';
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
        }
        $lecturer = Mentor::where('user_id', $user->id)->first();
        if(!$lecturer){
            $lecturer = Pic::with('mitra')->where('user_id', $user->id)->first();
            $query = Student::with('mitra');
            if($name != ''){
                $query->where('name', 'ILIKE', "%{$name}%");
            }
            $students = $query->where('mitra_id', $lecturer->mitra->id)->get();
        } else {
            $query = Student::with('mitra');
            if($name != ''){
                $query->where('name', 'ILIKE', "%{$name}%");
            }
            $students = $query->where('dpa', $lecturer->id)->orWhere('dpl', $lecturer->id)->get();
        }

        return view('students.lecturers.students', compact('students'));
    }

    public function details($nim){
        $student = Student::where('nim', $nim)->first();
        $data = StudentReport::with('attendance')
            ->with('approval')
            ->with('mitra_approval')
            ->with('attachment')
            ->where('student_id', $student->id)
            ->where('type', 'daily')
            ->orderBy('intern_date')
            ->get();

        return view('students.lecturers.details', compact('student', 'data'));
    }

    public function add_notes(Request $request){
        // dd($request->all());
        $user = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $mentor = Mentor::where('user_id', $user->id)->first();
            if(!$mentor){
                $mentor = Pic::where('user_id', $user->id)->first();
            }
            if($mentor){
                $pic = Utils::isMentor($user->id);
                $lecturer = Utils::isLecturer($user->id);
                $student_report = StudentReport::findOrFail($request->report_id);

                if($lecturer){
                    if($request->approval_id != ''){
                        $approval = ApprovalReport::findOrFail($request->approval_id);
                        $approval->notes = $request->notes;
                        $approval->save();
                    } else {
                        ApprovalReport::create([
                            'student_report_id' => $request->report_id,
                            'mentor_id' => $mentor->id,
                            'notes' => $request->notes,
                            'type' => 'daily',
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);
                    }

                    $student_report->approved_by_lecturer = true;
                    $student_report->save();
                }

                if($pic){
                    if($request->mitra_approval_id != ''){
                        $approval = PicApproval::findOrFail($request->mitra_approval_id);
                        $approval->notes = $request->mitra_notes;
                        $approval->save();
                    } else {
                        PicApproval::create([
                            'student_report_id' => $request->report_id,
                            'mentor_id' => $mentor->id,
                            'notes' => $request->mitra_notes,
                            'type' => 'daily',
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);
                    }
                    $student_report->approved_by_partner = true;
                    $student_report->save();
                }
            }

            if($student_report->approved_by_lecturer && $student_report->approved_by_partner){
                $student_report->approved_at = $now;
                $student_report->save();
            }

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module' => 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status' => false, 'message' => ["Failed!"]]);
        }

        return json_encode(['status' => true, 'message' => "Success"]);
    }

    public function weekly($nim){
        $student = Student::where('nim', $nim)->first();
        $data = WeeklyReport::with('mitra_approval')->with('attachment')->with('approval')->where('student_id', $student->id)->orderBy('week_date')->get();
        return view('students.lecturers.reports.weekly', compact('student', 'data'));
    }

    public function add_weekly_notes(Request $request){
        // dd($request->all());
        $user = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $mentor = Mentor::where('user_id', $user->id)->first();
            if(!$mentor){
                $mentor = Pic::where('user_id', $user->id)->first();
            }
            if($mentor){
                $pic = Utils::isMentor($user->id);
                $lecturer = Utils::isLecturer($user->id);

                if($request->type == 'weekly'){
                    $student_report = WeeklyReport::findOrFail($request->report_id);
                } else if($request->type == 'monthly'){
                    $student_report = MonthlyReport::findOrFail($request->report_id);
                } else if($request->type == 'final'){
                    $student_report = FinalReport::findOrFail($request->report_id);
                }

                if($lecturer){
                    if($request->approval_id != ''){
                        $approval = ApprovalReport::findOrFail($request->approval_id);
                        $approval->notes = $request->notes;
                        $approval->save();
                    } else {
                        ApprovalReport::create([
                            'student_report_id' => $request->report_id,
                            'mentor_id' => $mentor->id,
                            'notes' => $request->notes,
                            'type' => $request->type,
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);
                    }
                    $student_report->approved_by_lecturer = true;
                    $student_report->save();
                }
                if($pic){
                    if($request->mitra_approval_id != ''){
                        $approval = PicApproval::findOrFail($request->mitra_approval_id);
                        $approval->notes = $request->mitra_notes;
                        $approval->save();
                    } else {
                        PicApproval::create([
                            'student_report_id' => $request->report_id,
                            'mentor_id' => $mentor->id,
                            'notes' => $request->mitra_notes,
                            'type' => $request->type,
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);
                    }
                    $student_report->approved_by_partner = true;
                    $student_report->save();
                }


                if($student_report->approved_by_lecturer && $student_report->approved_by_partner){
                    $student_report->approved_at = $now;
                    $student_report->save();
                }

                if (isset($request->rubrik)) {
                    if (Utils::isLecturer(Auth::user()->id)) {
                        $type = 'lecturer';
                    }elseif (Utils::isMentor(Auth::user()->id)) {
                        $type = 'mitra';
                    }
                    $rubrik = Rubrik::where('student_id', $request->student_id)->where('type', $type)->first();
                    $rubrik_file = Utils::save_daily_file($request->rubrik);
                    if($rubrik){
                        $rubrik->file = $rubrik_file;
                        $rubrik->updated_by = Auth::user()->name;
                        $rubrik->updated_at = Carbon::now();
                        $rubrik->save();
                    } else {
                        Rubrik::create([
                            'student_id' => $request->student_id,
                            'file' => $rubrik_file,
                            'type' => $type,
                            'status' => 'active',
                            'created_by' => Auth::user()->name,
                            'updated_by' => Auth::user()->name,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module' => 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status' => false, 'message' => $e->getMessage()]);
        }

        return json_encode(['status' => true, 'message' => "Success"]);
    }

    public function monthly($nim){
        $student = Student::where('nim', $nim)->first();
        $data = MonthlyReport::with('mitra_approval')->with('attachment')->with('week_reports')->with('approval')->where('student_id', $student->id)->orderBy('month_date')->get();
        return view('students.lecturers.reports.monthly', compact('student', 'data'));
    }

    public function final($nim){
        $student = Student::where('nim', $nim)->first();
        $final = FinalReport::with('mitra_approval')->with('approval')->with('attachment')->where('student_id', $student->id)->first();
        // $student_report = FinalReportAttachment::where('report_id', $final->id)->pluck('file')->first();
        // dd($student_report);
        if (Utils::isLecturer(Auth::user()->id)) {
            $type = 'lecturer';
        } elseif(Utils::isMentor(Auth::user()->id)) {
            $type = 'mitra';
        }
        
        $rubrik = Rubrik::where('student_id', $student->id)->where('type', $type)->first();
        return view('students.lecturers.reports.final', compact('student', 'final', 'rubrik'));
    }

    public function assignment($nim){
        $student = Student::where('nim', $nim)->first();
        $data = Task::with('student_task')->with('approval')->with('attachment')->where('student_id', $student->id)->get();
        return view('students.lecturers.reports.assignment', compact('student', 'data'));
    }

    public function add_assignment_notes(Request $request){
        // dd($request->all());
        $user = Auth::user();
        $now = Carbon::now();
        
        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $mentor = Pic::where('user_id', $user->id)->first();
            if($mentor){
                $student_task = StudentTask::findOrFail($request->assignment_id);

                if($request->approval_id != null){
                    $approval = ApprovalTask::findOrFail($request->approval_id);
                    $approval->notes = $request->notes;
                    $approval->save();
                } else {
                    ApprovalTask::create([
                        'student_task_id' => $student_task->id,
                        'mentor_id' => $mentor->id,
                        'notes' => $request->notes,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);
                }

                $student_task->approved_by_lecturer = true;
                $student_task->updated_at = $now;
                $student_task->save();
            }
            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module' => 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status' => false, 'message' => ["Failed!"]]);
        }

        return json_encode(['status' => true, 'message' => "Success"]);
    }

    public function assignment_index(){
        $user = Auth::user();
        $mentor = Pic::where('user_id', $user->id)->first();
        $tasks = Task::with('student')->where('mentor_id', $mentor->id)->orderByDesc('updated_at')->get();
        // $students = Student::where('dpa', $mentor->id)->orWhere('dpl', $mentor->id)->get();
        return view('students.lecturers.assignment', compact('tasks'));
    }

    public function assignment_submit(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $user = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $mentor = Pic::with('students')->where('user_id', $user->id)->first();
            // $students = Student::where('dpa', $mentor->id)->orWhere('dpl', $mentor->id)->get();
            $image = Utils::save_career_file($request->upload_cont_img);
            foreach ($mentor->students as $item) {
                Task::create([
                    'mentor_id' => $mentor->id,
                    'student_id' => $item->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $image,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'type' => $request->type,
                    'status' => 'active',
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status'=> false, 'message'=> "Failed!"]);
        }

        return json_encode(['status'=> true, 'message'=> "Berhasil!"]);
    }

    public function rubrik(){$user = Auth::user();
        $lecturer = Mentor::where('user_id', $user->id)->first();
        if(!$lecturer){
            $lecturer = Pic::with('mitra')->where('user_id', $user->id)->first();
            $query = Student::with('mitra');
            $students = $query->where('mitra_id', $lecturer->mitra->id)->get();
            $form = FinalForm::where('status', 'active')->where('type', 'mitra')->first();
        } else {
            $query = Student::with('mitra');
            $students = $query->where('dpa', $lecturer->id)->orWhere('dpl', $lecturer->id)->get();
            $form = FinalForm::where('status', 'active')->where('type', 'lecturer')->first();
        }

        return view('students.lecturers.reports.rubrik', compact('students', 'form'));
    }
}
