<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Student;
use App\Models\StudentTask;
use App\Models\Task;
use App\Models\TaskAttachment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function index(){
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $assignments = Task::with('student_task')->where('student_id', $student->id)->get();
        
        return view('students.assignment', compact('assignments'));
    }

    public function submit(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            's_title' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $user = Auth::user();
        $now = Carbon::now();
        

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $student = Student::where('user_id', $user->id)->first();
            $report = StudentTask::where('student_id', $student->id)->where('id', $request->assignment_id)->first();
            
            if($report){
                $report->title = $request->s_title;
                $report->save();
            } else {
                if(!$request->upload_file){
                    return json_encode(['status'=> false, 'message'=> ['Isi File!']]);
                }
                $report = StudentTask::create([
                    'student_id' => $student->id,
                    'title' => $request->s_title,
                    'task_id' => $request->id,
                    'approved_by_lecturer' => false,
                    'create_at' => $now,
                    'updated_at' => $now
                ]);
            }
            // Save File
            if ($request->upload_file) {
                $attachment = TaskAttachment::where('task_id', $request->assignment_id)->delete();
                $files = 0;
                foreach ($request->upload_file as $item) {
                    $file = Utils::save_monthly_file($item);
                    TaskAttachment::create([
                        'task_id' => $report->id,
                        'file' => $file
                    ]);
                    $files++;
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status'=> false, 'message'=> [$e->getMessage()]]);
        }

        return json_encode(['status'=> true, 'message'=> "Success"]);
    }
}
