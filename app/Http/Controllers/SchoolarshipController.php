<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Career;
use App\Models\Category;
use App\Models\JobVacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SchoolarshipController extends Controller
{
    public function index(Request $request){
        
        $search = $request->search ? $request->search : null;
        $location = $request->location ? $request->location : null;
        $query = JobVacancy::where('status', 'approved');
        if(isset($search))
        {
            $query->where('title', 'ILIKE', "%{$search}%");
        }
        $schoolarships = $query->where('category_id', 1)->orderByDesc('id')->paginate(5);
        $links = [];

        if($schoolarships){
            $schoolarships->appends(['search' => $search])->links();
            $links  = $schoolarships->toArray()['links'];
        }

        $randoms = JobVacancy::where('category_id', 1)->where('status', 'approved')->limit(5)->inRandomOrder()->get();

        return view('students.schoolarship', compact('schoolarships' , 'links' , 'search' ,'randoms'));
    }

    public function create(){
        $schoolarships = Career::where('category_id', 1)->where('status', 'active')->where('type', 'approved')->get();
        return view('students.create-schoolarship', compact('schoolarships'));
    }

    public function submit(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'name' => 'required',
            'file' => 'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> false, 'message'=> $validation->messages()]);
        }
        $category = Category::where('category', 'shcoolarship')->pluck('id')->first();
        $now = Carbon::now();
        $user = Auth::user();
        if($user){
            if ($request->file != null) {
                $file = Utils::save_career_file($request->file);
            } else {
                $file = null;
            }
            JobVacancy::create([
                'category_id' => $category,
                'title' => $request->title,
                'description' => $request->description,
                'status' => 'pending',
                //'type' => 'pending',
                'slug' => Utils::slugify($request->title).'-'.Str::random(6),
                'image' => $file,
                'created_at' => $now,
                'updated_at' => $now,
                'created_by' => $user->name,
                'updated_by' => $user->name
            ]);
            return json_encode(['status' => true, 'message'=>"Succeed"]);
        }
        return json_encode(['status' => false, 'message'=>["Failed"]]);
    }

    public function detail($slug){
        $randoms = JobVacancy::where('category_id', 1)->where('status', 'approved')->limit(5)->inRandomOrder()->get();
        $data = JobVacancy::where('slug', $slug)->where('status', 'approved')->first();
        return view('students.detail-schoolarship', compact('data', 'randoms'));
    }
}
