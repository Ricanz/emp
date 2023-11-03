<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Career;
use App\Models\Category;
use App\Models\JobVacancy;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(){
        // $jobs = Career::where('type', 'approved')
        //         ->where('status', 'active')
        //         ->where('category_id', 2)
        //         ->orderByDesc('updated_at')
        //         ->get();
        $jobs = JobVacancy::where('status', 'approved')->whereIn('category_id', [2])->orderByDesc('created_at')->get();
        return view('students.job-vacancy', compact('jobs'));
    }

    public function vacancy(Request $request){
        $locations = Location::where('status' , 'active')->get();
        $search = $request->search ? $request->search : null;
        $category = $request->category ? $request->category : null;
        $location = $request->location ? $request->location : null;
        $query = JobVacancy::where('status', 'approved')->with('locat');

    
        if(isset($search))
        {
            $query->where('title', 'ILIKE', "%{$search}%");
        }
        if(isset($location))
        {
            $query->where('location', $location);
        }

        if(isset($category))
        {
            $query->where('category_id', $category);
        }else{
            $query->whereIn('category_id', [2,5,6,7]);
        }

        $jobs = $query->orderByDesc('id')->paginate(5);
        
        $links = [];

        if($jobs){
            
            $jobs->appends(['search' => $search, 'location' => $location , 'category' => $category])->links();
            $links  = $jobs->toArray()['links'];
        }
        
        return view('students.job-vacancy', compact('jobs' , 'links' ,'locations' ,'location' , 'search' , 'category'));

    }

    public function create(){
        $location = Location::where('status' , 'active')->get();
        return view('students.job-vacancy-create' , compact('location'));
    }

    public function create_tips(Request $request){
        if($request->type =='career_development'){
            $title = 'Tips Pengembangan Karir';
        }
        if($request->type  =='job_tips'){
            $title = 'Tips Melamar Kerja';
        }
        $location = Location::where('status' , 'active')->get();
        return view('students.tips-articles-create' , compact('location' , 'title'));
    }

    public function submit(Request $request){
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'image' => 'required',
            'description' => 'required',
            'end_date' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $category = 0;
        
        if(isset($request->category)){
            $category = Category::where('category' , $request->category)->first();
        }
        // dd($request->category);
        $user = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $image = Utils::save_career_file($request->image);
            $slug = Utils::slugify($request->title).strtolower(Str::random(6));
            JobVacancy::create([
                'title' => $request->title,
                'company' => $request->company,
                'location' => $request->location,
                'image' => $image,
                'description' => $request->description,
                'end_date' => $request->end_date,
                'status' => 'pending',
                'category_id' => $category->id,
                'slug' => $slug,
                'created_at' => $now,
                'updated_at' => $now,
                'created_by' => $user->name,
                'updated_by' => $user->name
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status'=> false, 'message'=> "Failed!"]);
        }

        return json_encode(['status'=> true, 'message'=> "Berhasil!"]);
    }


    public function submit_tips(Request $request){
    
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $category = 0;
       
        if(isset($request->type)){
            $category = Category::where('category' , $request->type)->first();
        }
        $user = Auth::user();
        $now = Carbon::now();

        DB::beginTransaction();
        DB::enableQueryLog();
        try {
            $image = Utils::save_career_file($request->image);
            $slug = Utils::slugify($request->title).strtolower(Str::random(6));
            JobVacancy::create([
                'title' => $request->title,
                //'company' => $request->company,
                //'location' => $request->location,
                'image' => $image,
                'description' => $request->description,
                //'end_date' => $request->end_date,
                'status' => 'pending',
                'category_id' => $category->id,
                'slug' => $slug,
                'created_at' => $now,
                'updated_at' => $now,
                'created_by' => $user->name,
                'updated_by' => $user->name
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            Log::channel('errorlog')->info(['module'=> 'Order', 'message' => $e->getMessage(), 'query' => '']);
            DB::rollback();
            return json_encode(['status'=> false, 'message'=> "Failed!"]);
        }

        return json_encode(['status'=> true, 'message'=> "Berhasil!"]);
    }

    public function details($slug){
        $job = JobVacancy::where('status', 'approved')->where('slug', $slug)->first();
       
        $locations = Location::where('status' , 'active')->get();
        return view('students.job-vacancy-details', compact('job' , 'locations'));
    }
}
