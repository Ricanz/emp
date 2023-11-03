<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;


class LecturerController extends Controller
{
    public function index(){
        $data = Mentor::where('status', '!=', 'deleted')->where('role', 'lecturer')->orderBy('name')->get();
        return view('admins.lecturer.index', compact('data'));
    }

    public function create(){
        return view('admins.lecturer.create');
    }

    public function submit(Request $request){
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
                $mentor = Mentor::create([
                    'name' => $request->name,
                    'nidn' => $request->nidn,
                    'user_id' => $user->id,
                    'image' => $image,
                    'status' => $request->status,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'role' => 'lecturer',
                    'jenis' => $request->role,
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

    public function edit($id , $page){
        // $data = Mentor::findOrFail($id);
        // return view('admins.lecturer.edit', compact('data'));
        if($page == 'profile'){
            return $this->profile($id , $page);
        }
        if($page == 'password'){
            return $this->password_page($id , $page);
        }
        if($page == 'students'){
            return $this->students($id , $page);
        }
        

    }

    public function students($id , $page){
        $user = Auth::user();
        $lecturer = Mentor::findOrFail($id)->where('role' , 'lecturer');
        $students = Student::with('mitra')->where('dpa', $id)->orWhere('dpl', $id)->where('status' , 'active')->get();
        return  view('admins.lecturer.profile.students', compact('id' , 'page' , 'lecturer' ,'students'));
    }

    public function profile($id , $page){
        $data = Mentor::findOrFail($id);
        return view('admins.lecturer.edit', compact('data' , 'page'));
    }

    public function password_page($id , $page){
        return view('admins.lecturer.profile.password', compact('id' , 'page' ));
    }
    

    public function update(Request $request){
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
            $mentor = Mentor::where('id', $request->id)->where('role', 'lecturer')->first();
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
                $mentor->email = $request->email;
                $mentor->gender = $request->gender;
                $mentor->status = $request->status;
                $mentor->jenis = $request->role;
                $mentor->nidn = $request->nidn;
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
}
