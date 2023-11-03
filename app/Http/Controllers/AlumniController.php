<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Alumni;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    public function index(){
        $user = Auth::user();
        $alumni = Alumni::where('user_id', $user->id)->first();

        return view('students.alumni.index', compact('alumni'));
    }

    public function register_alumni(Request $request){
        // dd($request->all());

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'image' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status' => false, 'message' => $validation->messages()]);
        }
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'alumni',
                'password' => Hash::make($request->password),
            ]);
            if ($user) {
                if ($request->image != null) {
                    $extention = $request->image->extension();
                    $file_name = time() . '.' . $extention;
                    $txt = "storage/alumni/" . $file_name;
                    $request->image->storeAs('public/alumni', $file_name);
                    $image = $txt;
                } else {
                    $image = null;
                }

                $alumni = Alumni::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'major_id' => $request->major_id,
                    'phone' => $request->phone,
                    'status' => 'active',
                    'gender' => $request->gender,
                    'year_of' => $request->year_of,
                    'year_graduate' => $request->year_graduate,
                    'is_approved' => false,
                    'history' => $request->history,
                    'created_at' => $now,
                    'updated_at' => $now,
                    'image' => $image
                ]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module' => 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status' => false, 'message' => ['Gagal Registrasi']]);
        }

        return json_encode(['status' => true, 'message' => "Success"]);
    }

    public function alumni(){
        $alumni = Alumni::select('alumni.name as name', 'alumni.phone as phone', 'alumni.history as history', 'faculties.name as faculty', 'majors.name as major', 'year_graduate', 'image')
                    ->with('major')
                    ->leftJoin('majors', 'alumni.major_id', 'majors.id')
                    ->leftJoin('faculties', 'majors.faculty_id', 'faculties.id')
                    ->where('alumni.status', 'active')->where('is_approved', true);
        // dd($alumni->get());
        if(isset($_GET['filter'])){
            $filter = $_GET['filter'];
            if($filter == 'newest'){
                $alumni = $alumni->orderByDesc('created_at');
            } else if($filter == 'abjad'){
                $alumni = $alumni->orderBy('name');
            } else if($filter == 'year'){
                $alumni = $alumni->orderBy('year_graduate');
            }
        }

        if(isset($_GET['year'])){
            $year = $_GET['year'];
            $alumni = $alumni->where('year_graduate', $year);
        }

        if(isset($_GET['alumni_name'])){
            $name = $_GET['alumni_name'];
            $alumni = $alumni->where('alumni.name', 'ILIKE', "%{$name}%");
        }

        $alumni = $alumni->get();
        // dd($alumni);
        $years = Alumni::select('year_graduate as year')->where('status', 'active')->where('is_approved', true)->groupBy('year_graduate')->get();
        // dd($alumni[0]);
        return view('students.alumni', compact('alumni', 'years'));
    }

    public function update_image(Request $request){
        $user = Auth::user();

        $alumni = Alumni::where('user_id', $user->id)->first();
        if($user){
            // Delete file from storage
            if(File::exists(public_path($alumni->image))){
                File::delete(public_path($alumni->image));
            }
            
            $image = Utils::save_daily_file($request->image);
            $alumni->image = $image;
            $alumni->save();

            return json_encode(['status' => true, 'message' => "Success"]);
        }
        return json_encode(['status' => false, 'message' => "Gagal Upload Gambar!"]);
    }
}
