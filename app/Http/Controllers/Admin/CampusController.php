<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyStoreRequest;
use App\Models\Alumni;
use App\Models\Career;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CampusController extends Controller
{
    public function faculty_view(){
        $data = Faculty::where('status', '!=', 'deleted')->orderBy('name')->get();

        return view('admins.faculties.index', compact('data'));
    }

    public function faculty_create(){
        return view('admins.faculties.create');
    }

    public function faculty_submit(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $user = Auth::user();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            Faculty::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'created_by' => $user->name,
                'updated_by' => $user->name
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return false;
        }

        return json_encode(['status'=> true, 'message'=> "Success"]);
    }

    public function faculty_edit($id){
        $faculty = Faculty::findOrFail($id);

        return view('admins.faculties.edit', compact('faculty'));
    }

    public function faculty_update(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $user = Auth::user();
        $faculty = Faculty::findOrFail($request->id);
        
        if($faculty){
            $faculty->name = $request->name;
            $faculty->description = $request->description;
            $faculty->status = $request->status;
            $faculty->updated_by = $user->name;

            if($faculty->save()){
                return json_encode(['status'=> true, 'message'=> "Success", 'code'=>200]);
            }
        }

        return json_encode(['status'=> false, 'message'=> "Failed!", 'code'=> 204]);
    }

    public function major_view(){
        $data = Major::with('faculty')->where('status', 'active')->orderBy('updated_at')->get();
        return view('admins.majors.index', compact('data'));
    }

    public function major_create(){
        $faculties = Faculty::orderBy('name')->where('status', 'active')->get();
        return view('admins.majors.create', compact('faculties'));
    }

    public function major_submit(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'faculty_id'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $user = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            Major::create([
                'name' => $request->name,
                'faculty_id' => $request->faculty_id,
                'description' => $request->description,
                'status' => $request->status,
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

    public function major_edit($id){
        $major = Major::with('faculty')->where('id', $id)->first();
        $faculties = Faculty::orderBy('name')->where('status', 'active')->get();
        return view('admins.majors.edit', compact('major', 'faculties'));
    }

    public function major_update(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'faculty_id'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }

        $user = Auth::user();
        $now = Carbon::now();
        
        $major = Major::findOrFail($request->id);
        if($major){
            $major->name = $request->name;
            $major->faculty_id = $request->faculty_id;
            $major->description = $request->description;
            $major->status = $request->status;
            $major->updated_by = $user->name;
            $major->updated_at = $now;

            if($major->save()){
                return json_encode(['status'=> true, 'message'=> "Success", 'code'=>200]);
            }
        }

        return json_encode(['status'=> false, 'message'=> "Failed!", 'code'=> 204]);
    }

    public function alumni(){
        $data = Alumni::where('status', '!=', 'deleted')->get();
        return view('admins.alumni.index' , compact('data'));
    }

    public function alumni_update(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $alumni = Alumni::where('id' , $request->id)->first();
        if(!$alumni){
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf! User tidak ditemukan.',
            ]);
        }
        $alumni->is_approved = true;
        if(isset($request->image)){
            $file = Utils::save_career_file($request->image);
        } else {
            $file = $alumni->image;
        }
        if(isset($request->is_approve)){
            $alumni->is_approved = $request->is_approve == 'active' ? true : false;
        }
        $alumni->name = isset($request->name) ? $request->name : $alumni->name;
        $alumni->email = isset($request->email) ? $request->email : $alumni->email;
        $alumni->gender = isset($request->gender) ? $request->gender : $alumni->gender;
        $alumni->phone = isset($request->phone) ? $request->phone : $alumni->phone;
        $alumni->status = isset($request->status) ? $request->status : $alumni->status;
        $alumni->image = $file;

        if(!$alumni->save()){
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf! Saat ini tidak dapat mengupdate data.',
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data telah diupdate.',
        ]);
    }

    public function alumni_post_update(Request $request){
        $validation = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);
        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $post = Career::where('id' , $request->id)->first();
        if(!$post){
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf! User tidak ditemukan.',
            ]);
        }
        $post->type = $request->status ==  'approve' ? 'approved' : 'pending';
        $post->updated_by = Auth::user()->name;
        $post->updated_at = date('Y-m-d H:i:s');
        if(!$post->save()){
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf! User tidak ditemukan.',
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate.',
        ]);
        
    }

    public function alumni_detail($id , $page){
        $alumni = Alumni::where('id' , $id)->first();
        if($page == 'career'){
        }
        if($page == 'post'){

            $posts = Career::where('user_id' , $alumni->user_id)->with('category')->orderBy('id' , 'DESC')->get();
            //print_r($posts->toJson()); exit;
            return view('admins.alumni.profile.post' , compact('alumni' , 'page' , 'id' , 'posts'));
        }
        if($page == 'password'){
            return view('admins.alumni.profile.password' , compact('alumni' , 'page' , 'id'));
        }
        if($page == 'profile'){
            
            return view('admins.alumni.edit' , compact('alumni' , 'page' , 'id'));
        }
    }

    public function password($id , $page){
        $alumni = Alumni::where('id' , $id)->first();
        return view('admins.alumni.edit' , compact('alumni' , 'page'));
    }

    public function update_password(Request $request){
        
        $validation = Validator::make($request->all(), [
            'password' => 'required|min:6|max:50|confirmed',
            'user_id' => 'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $alumni = Alumni::where('id' , $request->user_id)->first();
        if(!$alumni){
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan.',
            ]);
        }
        
        $user = User::where('id' , $alumni->user_id)->first();
        
        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            if(!$user){
                return response()->json([
                    'status' => 'error',
                    'message' => 'User tidak ditemukan.',
                ]);
            }
            $user->password = Hash::make($request->password);
            $user->updated_at = date('Y-m-d H:i:s');
            if(!$user->save()){
                return  response()->json(['status'=> false, 'message'=> ['Terjadi kesalahan, tidak dapat mengubah password1.']]);
            }
            DB::commit();
        } catch (\Throwable $e) {

            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return  response()->json(['status'=> false, 'message'=> $e->getMessage()]);
        }
        return  response()->json(['status'=> true, 'message'=> "Success"]);
    }
}
