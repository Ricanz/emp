<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\AboutCampus;
use App\Models\Career;
use App\Models\Category;
use App\Models\JobVacancy;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    static $INFO_TYPE = ['lesson' , 'advanced' , 'activity'];
    static $JOB_VACANCY_TYPE = ['career_development' => 8 , 'job_tips' => 3];


    public function index(Request $request){
        $type = $request->type;

        if(!array_key_exists($type , self::$JOB_VACANCY_TYPE)){
            return abort(404);
        }
        
        if(!array_key_exists($type , self::$JOB_VACANCY_TYPE)){
            return abort(404);
        }
        

        if($request->type =='career_development'){
            $title = 'Tips Pengembangan Karir';
        }
        if($request->type  =='job_tips'){
            $title = 'Tips Melamar Kerja';
        }
        
        $page = isset($request->page) ? $request->page : 1;
        $search = $request->search ? $request->search : null;
       // $location = $request->location ? $request->location : null;
        $query = JobVacancy::where('status', 'approved');
    
        if(isset($search))
        {
            $query->where('title', 'ILIKE', "%{$search}%");
        }
       

        $articles = $query->where('category_id', self::$JOB_VACANCY_TYPE[$type] )->orderByDesc('id')->paginate(3);
        
        $links = [];

        if($articles){
            $articles->appends(['search' => $search])->links();
            $links  = $articles->toArray()['links'];
        }else{
            $search = '';
        }
       // echo $search; exit;
        $relateds =  JobVacancy::where('status', 'approved')->where('category_id', self::$JOB_VACANCY_TYPE[$type] )->inRandomOrder(5)->get();
        return view('students.job-articles', compact('articles' , 'links', 'search' , 'page' , 'type' , 'title' , 'relateds'));
    }

    public function paging(Request $request){
        
        $type = $request->type;

        if(!array_key_exists($type , self::$JOB_VACANCY_TYPE)){
            return abort(404);
        }
        
        $page = isset($request->page) ? $request->page : 1;
        $query = JobVacancy::where('status', 'approved');
        if(isset($search))
        {
            $query->where('title', 'ILIKE', "%{$search}%");
        }
    
        $articles = $query->where('category_id', self::$JOB_VACANCY_TYPE[$type] )->skip($page * 3)->limit(3)->orderByDesc('id')->get();
         $html = '';
         if($articles){
             foreach($articles as $item){
                 $html .= $this->html_info($item);
             }
         }
         return  $html;
     }

    public function details($slug){
        $article = JobVacancy::where('slug', $slug)->where('status', 'approved')->with('cate')->first();
        return view('students.job-articles-details', compact('article'));
    }

    public function create_job_vacancies(Request $request){
        if($request->type =='career_development'){
            $title = 'Tips Pengembangan Karir';
        }
        if($request->type  =='job_tips'){
            $title = 'Tips Melamar Kerja';
        }
        return view('students.job-vacancy-create' , compact('title'));
    }

    public function create(Request $request){
        if($request->type =='lesson'){
            $title = 'Alumni Mengajar';
        }
        if($request->type  =='advanced'){
            $title = 'Studi Lanjut';
        }
        if($request->type  =='activity'){
            $title = 'Kegiatan Kampus';
        }
        return view('students.job-articles-create' , compact('title'));
    }

    public function submit(Request $request){
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
                'slug' => Utils::slugify($request->title).'-'.Str::random(6),
                'created_by' => Auth::user()->name,
                'cretad_at' => date('Y-m-d H:i:s'),
                'status' => isset($request->status) ? $request->status : 'pending',
                'uid' => Auth::user()->id
            ]
        );
        if(!$info){
            return  json_encode(['status'=> 'error', 'message'=> 'Gagal menyimpan data , silahkan kontak administrator.']);
        }

        return  json_encode(['status'=> 'success', 'message'=> 'Data telah disimpan , Admin akan memproses untuk menampilkan artikel']);

    }

    public function info_campus($page){
        
        if(!in_array($page , self::$INFO_TYPE)){
            return abort(404);
        }
        if($page =='lesson'){
            $title = 'Alumni Mengajar';
        }
        if($page =='advanced'){
            $title = 'Studi Lanjut';
        }
        if($page =='activity'){
            $title = 'Kegiatan Kampus';
        }
        $breadcrumbs = [
            $title => '/nfo/campus/'.$page
        ];
        $articles = AboutCampus::where('type' , $page)->orderBy('id' , 'DESC')->where('status' , 'posting')->limit(3)->get();
        $relateds = AboutCampus::where('type' , $page)->inRandomOrder(5)->get();
        return view('students.info_campus', compact('articles' , 'title' , 'breadcrumbs' , 'page' , 'relateds'));
    }
    public function info_campus_paging(Request $request){
       // print_r($request->all());exit;
        $page = isset($request->page) ? $request->page : 1;
        //echo $page * 3;exit;
        $articles = AboutCampus::where('type' , $request->type)->orderBy('id' , 'DESC')
        ->where('status' , 'posting')->skip($page * 3)->limit(3)->get();
       
        $html = '';
        if($articles){
            
            foreach($articles as $item){
                $html .= $this->html_info($item);
            }
        }
        return  $html;
        return json_encode(['status' => 'success' , 'message' => $html]);
    }

    public function html_info($item){
        return '
                <div class="col-lg-4 col-sm-12 mbottom-15">
                    <div class="card-article border-primary-grey rounded-sm">
                        <div class="container-banner sm">
                            <img class="img-default" src="'.url($item->image).'" alt="">
                        </div>
                        <div class=" p-15">
                            <span class="mbottom-30">'.$item->created_at->format('d M Y').'</span>
                            <h2 class="text-ellipsis-2 fs-16 mbottom-20">'.$item->title.'</h2>
                            <p class="text-ellipsis-2 mbottom-25">'.strip_tags($item->description).'</p>
                            <a href="'.url('/info/campus/detail)').$item->slug.'" class="decoration-none">
                                <div class="fp-blue fw-700">Lanjut Membaca</div>
                            </a>
                        </div>
                    </div>
                </div>
        ';
    }

    public function info_campus_detail($slug){
        //echo $slug; exit;
        $article = AboutCampus::where('slug' , $slug)->where('status' , 'posting')->first();

        if(!$article){
            return abort(404 , 'Artikel tidak ditemukan.');
        }
        if($article->type =='lesson'){
            $title = 'Alumni Mengajar';
        }
        if($article->type =='advanced'){
            $title = 'Studi Lanjut';
        }
        if($article->type =='activity'){
            $title = 'Kegiatan Kampus';
        }
        $page = $article->type;
        // $breadcrumbs = [
        //     $title => '/nfo/campus/'.$page
        // ];
        $relateds = AboutCampus::where('type' , $article->type)->where('status' , 'posting')->inRandomOrder(5)->get();
        return view('students.info_campus_detail', compact('article' , 'title' , 'relateds' , 'page'));
    }
}
