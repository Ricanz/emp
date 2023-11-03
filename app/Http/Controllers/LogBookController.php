<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Attendance;
use App\Models\DailyAttachment;
use App\Models\MonthlyReport;
use App\Models\Student;
use App\Models\StudentReport;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LogBookController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $data = StudentReport::with('attendance')
            ->with('attachment')
            ->with('approval')
            ->with('mitra_approval')
            ->where('student_id', $student->id)
            ->where('type', 'daily')
            ->orderBy('intern_date');
        
        if(isset($_GET['month'])){
            $month_filter = (new \Carbon\Carbon($_GET['month']));
            $data->whereMonth('intern_date', $month_filter);
        }
        $data = $data->get();
        $now = Carbon::now();
        $attendance = Attendance::whereDate('checkin', $now)->where('student_id', $student->id)->first();
        $current_report = StudentReport::where('student_id', $student->id)->whereDate('intern_date', $now)->first();
        $months = MonthlyReport::select('month')->where('student_id', $student->id)->groupBy('month')->get();

        return view('students.logbook', compact('data', 'attendance', 'current_report', 'months'));
    }

    public function checkin(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now()->format('Y-m-d');
        $student = Student::where('user_id', $user->id)->first();
        $report = StudentReport::where('student_id', $student->id)->where(DB::raw('DATE(intern_date)'), $now)->first();

        if ($report) {
            Attendance::create([
                'report_id' => $report->id,
                'student_id' => $student->id,
                'lat' => $request->latitude_clockin,
                'lng' => $request->longitude_clockin,
                'checkin' => Carbon::now(),
            ]);
            return json_encode(['status' => true, 'message' => "Success"]);
        }
        return json_encode(['status' => false, 'message' => "Failed"]);
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now()->format('Y-m-d');
        $student = Student::where('user_id', $user->id)->first();
        $report = StudentReport::where('student_id', $student->id)->where(DB::raw('DATE(intern_date)'), $now)->first();
        $attendance = Attendance::where('student_id', $student->id)->where('report_id', $report->id)->where(DB::raw('DATE(created_at)'), $now)->first();

        if ($attendance) {
            $attendance->checkout = Carbon::now();
            $attendance->save();
            $attendance->lat = $request->latitude_clockout;
            $attendance->lng = $request->longitude_clockout;

            return json_encode(['status' => true, 'message' => "Success"]);
        }

        return json_encode(['status' => false, 'message' => "Failed"]);
    }

    public function report(Request $request)
    {

        // dd($request->upload_file[2]);
        // dd(count($request->upload_file));
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'report' => 'required',
            // 'file' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        $user = Auth::user();
        $now = Carbon::now();


        DB::beginTransaction();
        DB::enableQueryLog();
        try {

            $student = Student::where('user_id', $user->id)->first();

            if (isset($request->report_id)) {
                $report = StudentReport::findOrFail($request->report_id);
            } else {
                $report = StudentReport::where('student_id', $student->id)->where(DB::raw('DATE(intern_date)'), $now)->first();
            }

            if ($report) {
                $report->title = $request->title;
                $report->reports = $request->report;
                $report->save();
            }

            if(isset($request->upload_file)){
                $attachment = DailyAttachment::where('report_id', $report->id)->delete();
                $files = 0;
                foreach ($request->upload_file as $item) {
                    $file = Utils::save_daily_file($item);
                    DailyAttachment::create([
                        'report_id' => $report->id,
                        'file' => $file
                    ]);
                    $files++;
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
}
