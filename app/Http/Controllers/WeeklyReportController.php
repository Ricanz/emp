<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Http\Resources\WeeklyResource;
use App\Models\MonthlyReport;
use App\Models\Student;
use App\Models\StudentReport;
use App\Models\WeeklyAttachment;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WeeklyReportController extends Controller
{
    public function weekly(Request $request){
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $weeks = WeeklyReport::with('user_reports')->where('student_id', $student->id);
        $week_loop = WeeklyReport::with('approval')->with('mitra_approval')->with('user_reports')->where('student_id', $student->id);
        if(isset($_GET['month'])){
            $month = $_GET['month'];
            $month_filter = (new \Carbon\Carbon($_GET['month']));
            $weeks->whereMonth('week_date', $month_filter);
        }
        if(isset($_GET['week'])){
            $week = $_GET['week'];
            $week_loop = $week_loop->where('week', $week);
        }

        $weeks = $weeks->orderBy('week_date')->get();
        $week_loop = $week_loop->orderBy('week_date')->get();
        // dd($week_loop);
        $datas = [];
        foreach ($week_loop as $item) {
            $student_reports = StudentReport::with('attendance')
                        ->where('student_id', $student->id)
                        ->where('type', 'daily')
                        ->where('week_id', $item->id)
                        ->orderBy('intern_date')
                        ->get();
            $first = (new \Carbon\Carbon($item->week_date))->addDay(1);
            $last = (new \Carbon\Carbon($item->week_date))->addDay(7);
            $attachments = WeeklyAttachment::where('week_id', $item->id)->get();

            $data = [
                'week_id' => $item->id,
                'week_date' => $item->week_date,
                'week' => $item->week,
                'weekly_report' => $item->reports,
                'student_reports' => $student_reports,
                'approved_by_lecturer' => $item->approved_by_lecturer,
                'approved_by_partner' => $item->approved_by_partner,
                'attachments' => $attachments == null ? null : $attachments,
                'range' => $first->format('d').' - '.$last->format('d').' '.$last->format('M').' '.$last->format('Y'),
                'lecturer_approval' => $item->approval ? $item->approval : null,
                'mitra_approval' => $item->mitra_approval ? $item->mitra_approval : null
            ];
            array_push($datas, $data);
        }

        $months = MonthlyReport::select('month', DB::raw('MIN(week) as week'))->where('monthly_reports.student_id', $student->id)
                    ->leftJoin('weekly_reports', 'monthly_reports.id', 'weekly_reports.month_id')
                    ->groupBy('month')->get();

        return view('students.weeklyreport', compact('weeks', 'datas', 'months'));
    }

    public function submit_weekly_report(Request $request){
        // dd($request->all());
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
            $report = WeeklyReport::where('student_id', $student->id)->where('id', $request->week_id)->first();
            if($report){
                if(isset($request->upload_file)){
                    $attachment = WeeklyAttachment::where('week_id', $request->week_id)->delete();
                    $files = 0;
                    foreach ($request->upload_file as $item) {
                        $file = Utils::save_weekly_file($item);
                        WeeklyAttachment::create([
                            'week_id' => $report->id,
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
            return json_encode(['status'=> false, 'message'=> "Failed!"]);
        }

        return json_encode(['status'=> true, 'message'=> "Success"]);
    }
}
