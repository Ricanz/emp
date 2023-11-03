<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="side-menu-log">
                    <button class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15 decoration-none" id="_to_create_article_">Posting Artikel</button>
                    <div class="rounded-sm border-primary-grey pt-30 pb-30 pr-20 pl-20 mbottom-30">
                        <h5 class="fp-black text-center mbottom-10">Artikel Lainnya</h5>
                        <div class="select-custom w-100 no-border mbottom-20" data-id="select_month">
                            <div class="option-item justify-between selected">
                               <ul class="related-article">
                                 @if(count($relateds) > 0)
                                    @foreach($relateds as $item)
                                        <li><a href="{{$item->slug}}">{{$item->title}}</a></li>
                                    @endforeach
                                 @endif
                               </ul>
                            </div>
                            <div id="preview_select_month" class="option-container transparent">
                                <div class="option-item">
                                    <input type="radio" class="radio" id="option1">
                                    <label for="">Februari</label>
                                </div>
                                <div class="option-item">
                                    <input type="radio" class="radio" id="option1">
                                    <label for="">Maret</label>
                                </div>
                                <div class="option-item">
                                    <input type="radio" class="radio" id="option1">
                                    <label for="">April</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log">
                    <div class="table-responsive">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                            <span class="fw-600 fp-white">{{$title}}</span>
                            <input type="hidden" value="{{$page}}" id="page-type"/>
                        </div>
                        <div class="report-table">
                            <div class="flex-center-between rounded-sm-top top-table-log border-bottom-none fixed-flex">
                                <h5 class="fp-black">Artikel - {{date('Y-m-d' , strtotime($article->created_at))}}</h5>
                                <a href="{{url()->previous()}}" class="decoration-none">
                                    <div class="flex-center">
                                        <img width="15" class="mright-5" src="{{ asset('/guestAssets/img/arrow-back.svg') }}" alt="">
                                        <h5 class="fp-black">Kembali</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="border-primary-grey rounded-sm-bottom p-25">
                                <div class="article-item flex-center details">
                                    <div class="col-lg-12 no-gutter d-flex flex-column">
                                        <small class="fs-11 mbottom-15">Tanggal Tautan : <b class="fs-10">{{ $article->created_at->format('d M Y') }}</b></small>
                                        <img class="banner mbottom-15" src="{{ asset($article->image) }}" alt="">
                                        <h5 class="mtop-5 mbottom-10">{{ $article->title }}</h5>
                                        <div class="article-description">
                                            {!! $article->description !!}
                                        </div>
                                    </div>
                                </div>
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
