<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function home(){
        $user = Auth::user();
        if($user->role == 'admin'){
            return redirect()->route('admin.main.dashboard');
        }

        $student = Student::where('user_id', $user->id)->first();
        if($student->status != 'active'){
            return redirect()->route('logout');
        }

        return view('students.index', compact('student'));
    }

    public function test_util(){
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');
        
        $week = WeeklyReport::where('student_id', $student->id)
                ->whereMonth('week_date', 12)
                ->whereBetween('week_date', [$weekStartDate, $weekEndDate])
                ->orderByDesc('week_date')->first();
        dd($week);
    }
}
