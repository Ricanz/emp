<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="side-menu-log">
                    @if(Auth::user()->role == 'alumni')
                        <button class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15 decoration-none _to_create_tips_article_">Posting Artikel</button>
                    @endif
                    <div class="rounded-sm border-primary-grey pt-30 pb-30 pr-20 pl-20 mbottom-30">
                        <h5 class="fp-black text-center mbottom-20">Archive</h5>
                        <div class="option-item justify-between selected">
                            <ul class="related-article">
                              @if(count($relateds) > 0)
                                 @foreach($relateds as $item)
                                     <li><a href="{{'job-articles-details/'.$item->slug}}">{{$item->title}}</a></li>
                                 @endforeach
                              @endif
                            </ul>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log">
                    <div class="table-responsive">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                            <span class="fw-600 fp-white">{{$title}}</span>
                        </div>
                        <div class="report-table">
                            {{-- <div class="content-table-article flex-center m-auto">
                                <h5 class="fp-black m-auto fw-400">Belum Ada Aktivitas</h5>
                            </div> --}}
                            @csrf
                            <input type="hidden" value="{{$page}}" id="page-type"/>
                            <input type="hidden" value="{{$type}}" id="type_page"/>
                            <div class="content-table-article flex-wrap flex-center mbottom-20" id="content-campus-info">
                                @foreach ($articles as $item)
                                    <div class="col-lg-4 col-sm-12 mbottom-15">
                                        <div class="card-article border-primary-grey rounded-sm">
                                            <div class="container-banner sm">
                                                <img class="img-default" src="{{ url($item->image) }}" alt="">
                                            </div>
                                            <div class=" p-15">
                                                <span class="mbottom-30">{{ $item->created_at->format('d M Y') }}</span>
                                                <h2 class="text-ellipsis-2 fs-16 mbottom-20">{{ $item->title }}</h2>
                                                <p class="text-ellipsis-2 mbottom-25">{{ strip_tags($item->description) }}</p>
                                                <a href="{{ url('/job-articles-details/'.$item->slug)}}" class="decoration-none">
                                                    <div class="fp-blue fw-700">Lanjut Membaca</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                           
                            <div class="row flex-wrap">
                                @if(Auth::user()->role == 'alumni')
                                    <div class="col-lg-4 col-sm-12 mbottom-15">
                                        <button class="btn-add btn-rounded-sm justify-left p-20 w-100 pointer fs-15 border-primary-transparent _to_create_tips_article_">Posting Artikel</button>
                                    </div>
                                    <div class="col-lg-8 col-sm-12">
                                        <button class="fs-14 btn-rounded-sm rounded-sm white border-primary-grey p-20 w-100 pointer" id="load_more_info">
                                            Lihat Artikel Lainnya
                                        </button>
                                    </div>
                                    @else
                                    <div class="col-lg-12 col-sm-12">
                                        <button class="fs-14 btn-rounded-sm rounded-sm white border-primary-grey p-20 w-100 pointer" id="load_more_info">
                                            Lihat Artikel Lainnya
                                        </button>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/job-articles.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>

<script>
 var page = 2;
$("#load_more_info").click(function(){
    var token = $('input[name="_token"]').val();
    //var page = $("#page-type").val()
    var type = $("#type_page").val()
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        url: '/job-articles/paging',
        data : { page : page , type : type },
        success: function (response) {
          
            if(!response){
                $('#load_more_info').hide()
            }
            console.log(response);
            page++
            $('#content-campus-info').append(response)
        }
    });
});

</script>