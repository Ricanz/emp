<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\Mitra;
use App\Models\Pic;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MitraController extends Controller
{
    public function index(){
        $data = Mitra::with('mentor')->where('status', '!=', 'deleted')->orderBy('name')->get();
        return view('admins.mitras.index', compact('data'));
    }

    public function create(){
        return view('admins.mitras.create');
    }

    public function submit(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $user = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            if ($request->image != null) {
                $extention = $request->image->extension();
                $file_name = time() . '.' . $extention;
                $txt = "storage/mitra/" . $file_name;
                $request->image->storeAs('public/mitra', $file_name);
                $image = $txt;
            } else {
                $image = null;
            }
            Mitra::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image,
                'status' => $request->status,
                'phone' => $request->phone,
                'address' => $request->address,
                'created_by' => $user->name,
                'updated_by' => $user->name,
                'created_at' => $now,
                'updated_at' => $now
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return false;
        }

        return json_encode(['status'=> true, 'message'=> "Success"]);
    }

    public function edit($id , $page){

        if($page == 'profile'){
            return $this->profile($id , $page);
        }
        if($page == 'password'){
            return $this->password_page($id , $page);
        }
        if($page == 'students'){
            return $this->profile_student($id , $page);
        }
        if($page == 'mentors'){
            return $this->mentors($id , $page);
        }
        if($page == 'mentors-new'){
            return $this->create_pic($id);
        }
    }

    public function mentors($id , $page){
        $mitra = Mitra::findOrFail($id);
        $mentors = Pic::with('student')->where('status', '!=', 'deleted')->with('user')->where('mitra_id', $id)->get();
        return  view('admins.mitras.profile.mentors', compact('id' , 'page' , 'mitra','mentors'));
    }
    public function profile_student($id , $page){
        $data  = [];
        $mitra = Mitra::findOrFail($id);
        $students = Student::where('mitra_id' , $id)->where('status' , 'active')->get();
        return  view('admins.mitras.profile.students', compact('id' , 'page' , 'data' ,'mitra' ,'students'));
    }

    public function password_page($id , $page){
        return view('admins.mitras.profile.password', compact('id' , 'page'));
    }

    public function profile($id, $page){
        $mitra = Mitra::findOrFail($id);
        return view('admins.mitras.edit', compact('mitra' , 'page'));
    }


    public function update(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $user = Auth::user();
        $now = Carbon::now();

        $mitra = Mitra::where('id', $request->id)->first();

        if($mitra){
            if ($request->image != null) {
                $extention = $request->image->extension();
                $file_name = time() . '.' . $extention;
                $txt = "storage/mitra/" . $file_name;
                $request->image->storeAs('public/mitra', $file_name);
                $image = $txt;
            } else {
                $image = $mitra->image;
            }
            $mitra->name = $request->name;
            $mitra->description = $request->description;
            $mitra->image = $image;
            $mitra->status = $request->status;
            $mitra->phone = $request->phone;
            $mitra->address = $request->address;
            $mitra->updated_by = $user->name;
            $mitra->updated_at = $now;

            if($mitra->save()){
                return json_encode(['status'=> true, 'message'=> "Success", 'code'=>200]);
            }

            return json_encode(['status'=> false, 'message'=> "Failed!", 'code'=> 204]);
        }
    }

    public function create_pic($mitra){
        $mitra = Mitra::findOrFail($mitra);
        $students = Student::where('status', 'active')->where('mitra_id', $mitra->id)->get();
        return view('admins.mitras.create-pic', compact('mitra', 'students'));
    }

    public function submit_pic(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required',
            'status' => 'required',
            'gender' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $admin = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'lecturer',
                'password' => Hash::make($request->password),
            ]);
    
            if($user){
                if ($request->image != null) {
                    $extention = $request->image->extension();
                    $file_name = time() . '.' . $extention;
                    $txt = "storage/mentor/" . $file_name;
                    $request->image->storeAs('public/mentor', $file_name);
                    $image = $txt;
                } else {
                    $image = null;
                }

                $mentor = Pic::create([
                    'user_id' => $user->id,
                    'student_id' => $request->student_id,
                    'mitra_id' => $request->mitra_id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'status' => 'active',
                    'image' => $image,
                    'created_by' => $admin->name,
                    'updated_by' => $admin->name,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);

                if($mentor){
                    // send email & password to user's contact (email/phone)
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return false;
        }

        return json_encode(['status'=> true, 'message'=> "Success"]);
    }

    public function edit_pic($id){
        $data = Pic::with('user')->where('id', $id)->first();
        $mitra = Mitra::where('id', $data->mitra_id)->first();
        $students = Student::where('status', 'active')->where('mitra_id', $mitra->id)->get();
        return view('admins/mitras.edit-pic', compact('data', 'mitra', 'students'));
    }

    public function update_pic(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'status' => 'required',
            'gender' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $admin = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $mentor = Pic::findOrFail($request->id);
            $user = User::where('email', $request->email)->first();
            if($mentor && $user){
                if($request->password != null){
                    $user->password = Hash::make($request->password);
                }
                $user->email = $request->email;
                $user->save();

                if ($request->image != null) {
                    $extention = $request->image->extension();
                    $file_name = time() . '.' . $extention;
                    $txt = "storage/mentor/" . $file_name;
                    $request->image->storeAs('public/mentor', $file_name);
                    $image = $txt;
                } else {
                    $image = $mentor->image;
                }

                $mentor->name = $request->name;
                $mentor->student_id = $request->student_id;
                $mentor->gender = $request->gender;
                $mentor->status = $request->status;
                $mentor->phone = $request->phone;
                $mentor->image = $image;
                $mentor->updated_by = $admin->name;
                $mentor->updated_at = $now;
                $mentor->save();

                if($mentor){
                    // send email & password to user's contact (email/phone)
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return false;
        }

        return json_encode(['status'=> true, 'message'=> "Success"]);
    }

    public function manage_pic($id){
        $mitra = Mitra::findOrFail($id);
        $mentors = Pic::where('status', '!=', 'deleted')->with('user')->with('student')->where('mitra_id', $id)->get();
        return view('admins.mitras.manage_pic', compact('mitra', 'mentors'));
    }
}
