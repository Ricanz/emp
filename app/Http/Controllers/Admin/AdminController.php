<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\AboutCampus;
use App\Models\Mentor;
use App\Models\Mitra;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Category;
use App\Models\FinalForm;
use App\Models\JobVacancy;
use App\Models\Location;
use App\Models\StudentReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard_view(){
        $student = Student::where('status' , 'active')->count();
        $lecturer = Mentor::where('role' , 'lecturer')->where('status' , 'active')->count();
        $mitra = Mitra::where('status' , 'active')->count();
        return view('admins.dashboard' , compact('student' , 'lecturer' , 'mitra'));
    }

    public function lesson(){
        $data = AboutCampus::where('type' , 'lesson')->orderBy('id' , 'DESC')->get();
        $type = 'lesson';
        $title = 'Alumni Mengajar';
        return view('admins.info.index' , compact('data' ,'title','type'));
    }

    public function advanced(){
        $data = AboutCampus::where('type' , 'advanced')->orderBy('id' , 'DESC')->get();
        $title = 'Studi Lanjut';
        $type = 'advanced';
        return view('admins.info.index' , compact('data' ,'title','type'));
        
    }
    
    public function activity(){
        $data = AboutCampus::where('type' , 'activity')->orderBy('id' , 'DESC')->get();
        $title = 'Kegiatan Kampus';
        $type = 'activity';
        return view('admins.info.index' , compact('data' ,'title','type'));
    }

    public function info_add($type){
        if($type =='lesson'){
            $title = 'Alumni Mengajar';
        }
        if($type =='advanced'){
            $title = 'Studi Lanjut';
        }
        if($type =='activity'){
            $title = 'Kegiatan Kampus';
        }
        $data = [];
        //$title = 'Tambah Postingan ';
        return view('admins.info.add' , compact('data' ,'title', 'type'));
    }

    public function info_edit($id ,$type){
        if($type =='lesson'){
            $title = 'Alumni Mengajar';
        }
        if($type =='advanced'){
            $title = 'Studi Lanjut';
        }
        if($type =='activity'){
            $title = 'Kegiatan Kampus';
        }
        $data = AboutCampus::where('id' , $id)->first();

        return view('admins.info.edit' , compact('data' ,'title', 'type'));
    }

    public function info_update(Request $request){
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'info_id' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image.*' => 'jpeg,png,jpg,gif,svg,webp',
        ]);
        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $post = AboutCampus::where('id' , $request->info_id)->first();

        if($request->hasFile('image')){
            $file = Utils::save_file_by_ext($request->file('image'),'image_only' , 'post-info');
            if($file[0] == false){
                return json_encode(['status'=> 'error', 'message'=> $file[1]]);
            }
            $post->image = $file[1];
        }

        if(!$post){
            return json_encode(['status' => 'error' , 'message' => 'Postingan tidak ditemukan']);
        }
        $post->title = $request->title;
        $post->type = $request->type;
        if($post->slug == ''){
            $post->slug = $this->slug($request->title).'-'.Str::random(6);
        }
        $post->description = $request->description;
        
        $post->status = isset($request->status) ? $request->status : 'pending';

        if(!$post->save()){
            return json_encode(['status' => 'error' , 'message' => 'Gagal saat menyimpan data , silahkan hubungi administrator']);
        }
        return json_encode(['status' => 'success' , 'message' => 'Data berhasil disimpan']);

    }

    public function info_store(Request $request){
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image.*' => 'jpeg,png,jpg,gif,svg,webp',
        ]);
        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        if($request->hasFile('image')){
            $file = Utils::save_file_by_ext($request->file('image'),'image_only' , 'post-info');
            if($file[0] == false){
                return json_encode(['status'=> 'error', 'message'=> $file[1]]);
            }
        }
        $info = AboutCampus::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $file[1],
                'type' => $request->type,
                'slug' => $this->slug($request->title).'-'.Str::random(6),
                'created_by' => Auth::user()->name,
                'cretad_at' => date('Y-m-d H:i:s'),
                'status' => isset($request->status) ? $request->status : 'pending'
            ]
        );
        if(!$info){
            return  json_encode(['status'=> 'error', 'message'=> 'Gagal menyimpan data , silahkan kontak administrator.']);
        }

        return  json_encode(['status'=> 'success', 'message'=> 'Data telah disimpan.']);
    }

    public function career($type){
        $cate = Category::where('category' , $type)->first();
        if(!$cate){
            return abort(404);
        }
        $query = JobVacancy::with('cate')->where('status', '!=', 'deleted');
        if($type =='job'){
            $title = 'Lowongan Kerja';   
            // $query->whereIn('category_id', [2, 5, 6, 7]);
            $query->whereIn('category_id', [2,5,6,7]);

            // dd($query->get());
        }
        if($type =='shcoolarship'){
            $title = 'Beasiswa';
            $query->where('category_id' , $cate->id);
        }
        if($type =='job_tips'){
            $title = 'Tips Melamar Kerja';
            $query->where('category_id' , $cate->id);
        }
        if($type =='career_development'){
            $title = 'Tips Pengembangan Karir';
            $query->where('category_id' , $cate->id);
        }
        $data = $query->get();
        // dd($data);
        
        return view('admins.career.index' , compact('data' ,'title', 'type'));
    }

    public function career_add($type){
        $cate = Category::where('category' , $type)->first();
        $locations = Location::where('status' , 'active')->orderBy('location' , 'ASC')->get();
        
        if($type =='job'){
            $title = 'Lowongan Kerja';   
        }
        
        if($type =='shcoolarship'){
            $title = 'Beasiswa';
        }
        
        if($type =='job_tips'){
            $title = 'Tips Melamar Kerja';
        }
        
        if($type =='career_development'){
            $title = 'Tips Pengembangan Karir';
        }
        $data = [];
        //$title = 'Tambah Postingan ';
        return view('admins.career.add' , compact('data' ,'title', 'type','cate' ,'locations'));
    }

    public function career_store(Request $request){
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image.*' => 'jpeg,png,jpg,gif,svg,webp',
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        if($request->hasFile('image')){
            $file = Utils::save_file_by_ext($request->file('image'),'image_only' , 'post-info');
            if($file[0] == false){
                return json_encode(['status'=> 'error', 'message'=> $file[1]]);
            }
        }else{
            $file = ['' ,''];
        }
        $info = JobVacancy::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $file[1],
                'category_id' => $request->category,
                'company' => isset($request->company) ? $request->company : '',
                'location' => isset($request->location) ? $request->location : 6,
                'end_date' => isset($request->end_date) ? $request->end_date : date('Y-m-d'),
                'slug' => $this->slug($request->title).'-'.Str::random(10),
                'type' => $request->type,
                'created_by' => Auth::user()->name,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => isset($request->status) ? $request->status : 'pending'
            ]
        );
        if(!$info){
            return  json_encode(['status'=> 'error', 'message'=> 'Gagal menyimpan data , silahkan kontak administrator.']);
        }
        return  json_encode(['status'=> 'success', 'message'=> 'Data telah disimpan.']);
    }

    public function career_update(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'career_id' => 'required',
            'description' => 'required',
            'image.*' => 'jpeg,png,jpg,gif,svg,webp',
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $job = JobVacancy::where('id' , $request->career_id)->first();

        //print_r($job); exit;

        if($request->hasFile('image')){
            $file = Utils::save_file_by_ext($request->file('image'),'image_only' , 'post-info');
            //print_r($file[1]); exit;
            if($file[0] == false){
                return json_encode(['status'=> 'error', 'message'=> $file[1]]);
            }
            $job->image = $file[1];
        }
        $job->title = $request->title;
        $job->description = $request->description;
        // $job->category_id = $request->category;
        $job->company = isset($request->company) ? $request->company : '';
        $job->location = isset($request->location) ? $request->location : 6;
        $job->end_date = isset($request->end_date) ? $request->end_date : date('Y-m-d');
        $job->slug = $this->slug($request->title).'-'.Str::random(10);
        $job->created_by = Auth::user()->name;
        $job->created_at = date('Y-m-d H:i:s');
        $job->status = isset($request->status) ? $request->status : 'pending';

        
        if(!$job->save()){
            return  json_encode(['status'=> 'error', 'message'=> 'Gagal menyimpan data , silahkan kontak administrator.']);
        }

        return  json_encode(['status'=> 'success', 'message'=> 'Data telah disimpan.']);
    }

    public function career_edit($id ,$type){
        $cate = Category::where('category' , $type)->first();
        $locations = Location::where('status' , 'active')->orderBy('location' , 'ASC')->get();

        if($type =='job'){
            $title = 'Lowongan Kerja';   
        }
        
        if($type =='shcoolarship'){
            $title = 'Beasiswa';
        }
        
        if($type =='job_tips'){
            $title = 'Tips Melamar Kerja';
        }
        
        if($type =='career_development'){
            $title = 'Tips Pengembangan Karir';
        }

        $data = JobVacancy::where('id' , $id)->first();

        return view('admins.career.edit' , compact('data' ,'title', 'type' , 'locations' , 'cate'));
    }

    public function slug($text){
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return false;
        }
        return $text;
    }

    public function final_form_create(){
        // dd("here");
        $user = Auth::user();
        $now = Carbon::now();
        $lecturer = FinalForm::where('status', 'active')->where('type', 'lecturer')->orderByDesc('id')->first();
        $mitra = FinalForm::where('status', 'active')->where('type', 'mitra')->orderByDesc('id')->first();
        if(!$lecturer){
            FinalForm::create([
                'file' => '',
                'status' => 'active',
                'type' => 'lecturer',
                'created_by' => $user->name,
                'updated_by' => $user->name,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
        if (!$mitra) {
            FinalForm::create([
                'file' => '',
                'status' => 'active',
                'type' => 'mitra',
                'created_by' => $user->name,
                'updated_by' => $user->name,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
        return view('admins.form.final', compact('lecturer', 'mitra'));
    }

    public function final_form_submit(Request $request){
        $lecturer = FinalForm::where('status', 'active')->where('type', 'lecturer')->orderByDesc('id')->first();
        $mitra = FinalForm::where('status', 'active')->where('type', 'mitra')->orderByDesc('id')->first();
        if($lecturer){
            if(isset($request->lecturer)){
                $file = Utils::save_monthly_file($request->lecturer);
            } else {
                $file = '';
            }
            $lecturer->file = $file;
            $lecturer->updated_by = Auth::user()->name;
            $lecturer->updated_at = Carbon::now();
            $lecturer->save();
        }

        if($mitra){
            if(isset($request->mitra)){
                $file_mitra = Utils::save_monthly_file($request->mitra);
            } else {
                $file_mitra = '';
            }
            $mitra->file = $file_mitra;
            $mitra->updated_by = Auth::user()->name;
            $mitra->updated_at = Carbon::now();
            $mitra->save();
        }

        return  json_encode(['status'=> true, 'message'=> 'Data telah disimpan.']);
    }

    public function login_title(){
        $title = AboutCampus::where('status', 'login')->first();
        if(!$title){
            AboutCampus::create([
                'title' => '',
                'description' => '',
                'status' => 'login',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);
        }
        return view('admins.login-title', compact('title'));
    }

    public function login_title_submit(Request $request){
        $title = AboutCampus::where('status', 'login')->first();
        if($title){
            $title->title = $request->title;
            $title->description = $request->sub;
            $title->updated_at = Carbon::now();
            $title->updated_by = Auth::user()->name;

            if($title->save()){
                return  json_encode(['status'=> true, 'message'=> 'Data telah disimpan.']);
            }
        }
        return  json_encode(['status'=> false, 'message'=> 'Gagal menyimpan data.']);
    }

    public function test_function(){
        $reports = StudentReport::where('student_id', 1)->get();
        $now = Carbon::now();

        foreach ($reports as $val) {
            if($val->intern_date != $now){
                $checkin = new \Carbon\Carbon($val->intern_date);
                $attendance = Attendance::where('report_id', $val->id)->first();
                if(!$attendance){
                    Attendance::create([
                        'student_id' => $val->student_id,
                        'report_id' => $val->id,
                        'checkin' => $checkin->addHour(9),
                        'checkout' => $checkin,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                } else {
                    $attendance->checkout = $checkin->addHour(17);
                    $attendance->save();
                }
            }
            echo '<p style="color: green">Congratulation Grace for your happiest day ever...</p>';
        }
        dd("berhasill");
    }

    public function delete_attendance(){
        $now = Carbon::now();
        $student = Student::where('id', 61)->first();
        $attendance = Attendance::where('student_id', $student->id)->get();
        foreach ($attendance as $item) {
            // dd($item->checkin >= $now);
            if ($item->checkin >= $now) {
                // dd($item->checkin);
                // $item->delete();
            }
        }
        return "berhasil menghapus attendance ".$student->name;

    }
}
