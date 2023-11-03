<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Answer;
use App\Models\Mentor;
use App\Models\Question;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class QnaController extends Controller
{
    public function index(){
        $user = Auth::user();
        $filter = '';
        if(isset($_GET['filter'])){
            $filter = $_GET['filter'];
        }

        if($user->role == 'student'){
            $student = Student::where('user_id', $user->id)->first();
            $question = Question::where('student_id', $student->id);
            if($filter == 'newest'){
                $question = $question->orderByDesc('created_at');
            } else if($filter == 'oldest'){
                $question = $question->orderBy('created_at');
            } else {
                $question = $question->orderByDesc('created_at');
            }

            $question = $question->get();

        } else if($user->role == 'lecturer'){
            $mentor = Mentor::where('user_id', $user->id)->first();
            $get_students = Student::where('dpa', $mentor->id)->orWhere('dpl', $mentor->id)->get();
            $students = [];
            foreach ($get_students as $item) {
                array_push($students, $item->id);
            }
            $question = Question::whereIn('student_id', $students);

            if($filter == 'newest'){
                $question = $question->orderByDesc('created_at');
            } else if($filter == 'oldest'){
                $question = $question->orderBy('created_at');
            } else {
                $question = $question->orderByDesc('created_at');
            }

            $question = $question->get();
        }

        return view('students.qna', compact('question'));
    }

    public function create(){
        return view('students.qna-form');
    }

    public function submit(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'question' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $user = Auth::user();
            $now = Carbon::now();
            if($user){
                $student = Student::where('user_id', $user->id)->first();
                $random_code = Str::random(8);
                Question::create([
                    'student_id' => $student->id,
                    'status' => 'active',
                    'question' => $request->question,
                    'created_at' => $now,
                    'updated_at' => $now,
                    'code' => $random_code
                ]);
            }
            // $image = Utils::save_career_file($request->image);

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status'=> false, 'message'=> "Failed!"]);
        }

        return json_encode(['status'=> true, 'message'=> "Berhasil!"]);
    }

    public function details($code){
        $data = Question::with('answer')->where('code', $code)->first();
        // dd($data);
        return view('students.qna-details', compact('data'));
    }

    public function submit_reply(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'reply' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $user = Auth::user();
            $now = Carbon::now();
            if($user){
                $qna = Question::findOrFail($request->question_id);
                if($qna){
                    $student = Student::where('user_id', $user->id)->first();
                    Answer::create([
                        'question_id' => $qna->id,
                        'status' => 'active',
                        'answer' => $request->reply,
                        'reply_by' => $user->role,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
            // $image = Utils::save_career_file($request->image);

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status'=> false, 'message'=> "Failed!"]);
        }

        return json_encode(['status'=> true, 'message'=> "Berhasil!"]);
    }
}
