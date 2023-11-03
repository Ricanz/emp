<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentReportResource;
use App\Models\Student;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function daily(){
        $data = StudentReport::select('student_id', 'students.name as name', 'mitras.name as mitra', DB::raw('DATE(students.start_date) as start_date'), DB::raw('DATE(students.end_date) as end_date'), 'students.nim')
                ->with('attendance')
                ->leftJoin('students', 'student_reports.student_id', 'students.id')
                ->leftJoin('mitras', 'students.mitra_id', 'mitras.id')
                ->where('type', 'daily')
                ->groupBy('student_id', 'mitras.name', 'students.name', 'students.start_date', 'students.end_date', 'students.nim')
                ->get();

        return view('admins.reports.daily.index', compact('data'));
    }

    public function daily_detail($id){
        $student = Student::findOrFail($id);
        $reports = StudentReport::with('attendance')->where('student_id', $id)->get();
        // dd($reports);
        return view('admins.reports.daily.detail', compact('reports', 'student'));
    }

    public function weekly(){
        $data = StudentReport::select('student_id', 'students.name as name', 'mitras.name as mitra', DB::raw('DATE(students.start_date) as start_date'), DB::raw('DATE(students.end_date) as end_date'), 'students.nim')
                ->with('attendance')
                ->leftJoin('students', 'student_reports.student_id', 'students.id')
                ->leftJoin('mitras', 'students.mitra_id', 'mitras.id')
                ->where('type', 'weekly')
                ->groupBy('student_id', 'mitras.name', 'students.name', 'students.start_date', 'students.end_date', 'students.nim')
                ->get();

        return view('admins.reports.weekly.index', compact('data'));
    }

    public function final(){
        $data = StudentReport::select('student_id', 'students.name as name', 'mitras.name as mitra', DB::raw('DATE(students.start_date) as start_date'), DB::raw('DATE(students.end_date) as end_date'), 'students.nim')
                ->with('attendance')
                ->leftJoin('students', 'student_reports.student_id', 'students.id')
                ->leftJoin('mitras', 'students.mitra_id', 'mitras.id')
                ->where('type', 'final')
                ->groupBy('student_id', 'mitras.name', 'students.name', 'students.start_date', 'students.end_date', 'students.nim')
                ->get();

        return view('admins.reports.final.index', compact('data'));
    }
}
