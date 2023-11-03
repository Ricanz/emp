<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\FinalForm;
use App\Models\FinalReport;
use App\Models\FinalReportAttachment;
use App\Models\MonthlyReport;
use App\Models\Rubrik;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FinalReportController extends Controller
{
    public function final(){
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $monthly_reports = MonthlyReport::with('approval')->with('mitra_approval')->where('student_id', $student->id)
                            ->where('type', 'monthly')
                            ->orderBy('month_date')
                            ->get();
        $final_report = FinalReport::with('attachment')->where('student_id', $student->id)->first();
        $form = FinalForm::where('status', 'active')->orderByDesc('id')->first();
        $rubrik_dosen = Rubrik::where('student_id', $student->id)->where('type', 'lecturer')->first();
        $rubrik_mitra = Rubrik::where('student_id', $student->id)->where('type', 'mitra')->first();
        return view('students.final-report', compact('monthly_reports', 'final_report', 'form', 'rubrik_dosen', 'rubrik_mitra'));
    }

    public function final_submit(Request $request){
        $validation = Validator::make($request->all(), [
            'report' => 'required',
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
            $report = FinalReport::where('student_id', $student->id)->where('id', $request->report_id)->first();
            $attachment = FinalReportAttachment::where('report_id', $request->report_id)->first();

            if($report){
                $report->reports = $request->report;
                $report->save();
            } else {
                if(!$request->upload_cont_img){
                    return json_encode(['status'=> false, 'message'=> ['Isi File!']]);
                }
                $report = FinalReport::create([
                    'student_id' => $student->id,
                    'reports' => $request->report,
                    'create_at' => $now,
                    'updated_at' => $now
                ]);
            }

            // Save File
            if ($request->upload_cont_img != null) {
                $file = Utils::save_monthly_file($request->upload_cont_img);
                if(!$attachment){
                    FinalReportAttachment::create([
                        'report_id' => $report->id,
                        'file' => $file
                    ]);
                } else {
                    $attachment->file = $file;
                    $attachment->updated_at = $now;
                    $attachment->save();
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
