<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\MonthlyAttachment;
use App\Models\MonthlyReport;
use App\Models\Student;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MonthlyReportController extends Controller
{
    public function monthly(){
        $params = $_GET['month'];
        
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $months = MonthlyReport::with('week_reports')->where('student_id', $student->id)->orderBy('month_date')->get();
        if(strlen($params) > 0){
            $month_loop = MonthlyReport::with('approval')->with('mitra_approval')->with('week_reports')->where('student_id', $student->id)->where('month', $params)->get();
        } else {
            $month_loop = MonthlyReport::with('approval')->with('mitra_approval')->with('week_reports')->where('student_id', $student->id)->get();
        }

        // if($month_loop->isEmpty()){
        //     dd("here", $months);
        // }

        $datas = [];

        foreach ($month_loop as $item) {
            $weekly_reports = WeeklyReport::with('lecturer_approval')
                        ->with('approval')
                        ->where('student_id', $student->id)
                        ->where('month_id', $item->id)
                        ->where('type', 'weekly')
                        ->orderBy('id')
                        ->get();

            $attachments = MonthlyAttachment::where('month_id', $item->id)->get();
            
            $data = [
                'month_id' => $item->id,
                'month' => $item->month,
                'monthly_reports' => $item->reports,
                'weekly_reports' => $weekly_reports,
                'approved_by_lecturer' => $item->approved_by_lecturer,
                'approved_by_partner' => $item->approved_by_partner,
                'attachments' => $attachments == null ? null : $attachments,
                'approved_at' => $item->approved_at,
                'lecturer_approval' => $item->approval ? $item->approval : '',
                'mitra_approval' => $item->mitra_approval ? $item->mitra_approval : '',
            ];
            array_push($datas, $data);
        }
        $moonths = MonthlyReport::select('month')->where('student_id', $student->id)->groupBy('month')->get();
        $current_month = $params;

        return view('students.monthlyreport', compact('months', 'datas', 'current_month', 'moonths'));
    }

    public function submit_monthly_report(Request $request){
        $validation = Validator::make($request->all(), [
            'report' => 'required',
            // 'file' => 'required',
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
            $report = MonthlyReport::where('student_id', $student->id)->where('id', $request->month_id)->first();

            if($report){
                // Save File
                if(isset($request->upload_file)){
                    $attachment = MonthlyAttachment::where('month_id', $request->month_id)->delete();
                    $files = 0;
                    foreach ($request->upload_file as $item) {
                        $file = Utils::save_monthly_file($item);
                        MonthlyAttachment::create([
                            'month_id' => $request->month_id,
                            'file' => $file
                        ]);
                        $files++;
                    }
                }
                $report->reports = $request->report;
                $report->save();
            }

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status'=> false, 'message'=> ["Failed!"]]);
        }

        return json_encode(['status'=> true, 'message'=> "Success"]);
    }
}
