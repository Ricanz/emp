<?php
namespace App\Helpers;

use App\Models\AboutCampus;
use App\Models\Alumni;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\Mentor;
use App\Models\Pic;
use App\Models\Student;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Utils {
    static $IMAGE_ONLY = ['jpeg','JPEG','WEBP','webp','PNG','png','JPG','jpg','svg'];
    static $ALL_FILE = ['jpeg','JPEG','WEBP','webp','PNG','png','JPG','jpg','svg','pdf','PDF','mp3','mp4','flv','3gp','avi','wmv','apk'];

    public static function slugify($text, $divider = '-')
    {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return false;
        }
        return $text;
    }

    public static function unslugify($text, $divider = '/') {
        $text = str_replace('-', $divider, $text);

        $text = strtoupper($text);
        if (empty($text)) {
            return false;
        }
        return $text;
    }

    public static function user(){
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        if(!$student){
            $student = Mentor::where('user_id', $user->id)->first();
            if(!$student){
                $student = Pic::where('user_id', $user->id)->first();
                if(!$student){
                    $student = Alumni::where('user_id', $user->id)->first();
                }
            }
        }
        return $student;
    }

    public static function save_image_file($filename){
        $file = '';
        $extention = $filename->extension();
        $file_name = Str::random(8) . time() . '.' . $extention;
        $txt = "storage/image/" . $file_name;
        $filename->storeAs('public/image', $file_name);
        $file = $txt;
        
        return $file;
    }

    public static function save_daily_file($filename){
        $file = '';
        $extention = $filename->extension();
        $file_name = Str::random(8) . time() . '.' . $extention;
        $txt = "storage/daily/" . $file_name;
        $filename->storeAs('public/daily', $file_name);
        $file = $txt;

        // Log::debug($file);
        return $file;
    }

    public static function save_file_by_ext($file , $type ,$folder){
        if($type == 'image_only'){
            if(!in_array($file->extension() , self::$IMAGE_ONLY)){
                return [false , 'Upload file hanya '.implode(',' ,self::$IMAGE_ONLY)];
            }
        }
        if($type == 'all_file'){
            if(!array_key_exists($file->extension() , self::$ALL_FILE)){
                return [false, 'Upload file hanya '.implode(',' ,self::$ALL_FILE)];
            }
        }
        $file_name = time() . '.' . $file->extension();
        $file->storeAs('/public/'.$folder, $file_name);
        $file = '/storage/'.$folder.'/'.$file_name;

        return [true , $file];;
    }

    public static function save_weekly_file($filename){
        $extention = $filename->extension();
        $file_name = Str::random(8) . time() . '.' . $extention;
        $txt = "storage/weekly/" . $file_name;
        $filename->storeAs('public/weekly', $file_name);
        $file = $txt;

        return $file;
    }

    public static function save_monthly_file($filename){
        $extention = $filename->extension();
        $file_name = Str::random(8) . time() . '.' . $extention;
        $txt = "storage/monthly/" . $file_name;
        $filename->storeAs('public/monthly', $file_name);
        $file = $txt;

        return $file;
    }

    public static function save_career_file($filename){
        $extention = $filename->extension();
        $file_name = time() . '.' . $extention;
        $txt = "storage/career/" . $file_name;
        $filename->storeAs('public/career', $file_name);
        $file = $txt;
        return $file;
    }

    public static function isLecturer($user_id){
        $lecturer = Mentor::where('user_id', $user_id)->first();

        if($lecturer){
            return true;
        } else if(!$lecturer){
            return false;
        }
    }

    public static function isMentor($user_id){
        $pic = Pic::where('user_id', $user_id)->first();

        if($pic){
            return true;
        } else if(!$pic){
            return false;
        }
    }

    public static function getFaculty(){
        $majors = Faculty::where('status', 'active')->get();
        return $majors;
    }

    public static function getMajor(){
        $majors = Major::where('status', 'active')->get();
        return $majors;
    }

    public function get_student_id($mentor_id){
        $get_students = Student::where('dpa', $mentor_id)->orWhere('dpl', $mentor_id)->get();
        $students = [];
        foreach ($get_students as $item) {
            array_push($students, $item->id);
        }

        return $students;
    }

    public static function get_current_week($month){
        $user = Auth::user();
        if($user->role == 'student'){
            $student = Student::where('user_id', $user->id)->first();
            
            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d');
            
            $week = WeeklyReport::where('student_id', $student->id)
                    ->whereMonth('week_date', $month)
                    ->whereBetween('week_date', [$weekStartDate, $weekEndDate])
                    ->orderByDesc('week_date')->first();
            if(!$week){
                return 1;
            }
            return $week->week;
        }
        return 1;
    }

    public static function login_title(){
        $title = AboutCampus::where('status', 'login')->first();
        return $title;
    }
}