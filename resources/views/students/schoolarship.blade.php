<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12 mbottom-15">
                <div class="side-menu-log">
                    @if(Auth::user()->role == 'alumni')
                        <button class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15" id="post_schoolarship">Posting Beasiswa</button>
                    @endif
                    <div class="rounded-sm border-primary-grey pt-30 pb-30 pr-20 pl-20">
                        <h5 class="fp-black text-center mbottom-20">Cari Beasiswa</h5>
                        <div class="search-component mbottom-15">
                            <img width="20" src="{{ asset('/guestAssets/img/search.svg') }}" alt="">
                            <form action="">
                                <input class="w-100" placeholder="Cari Beasiswa" type="search" name="search" value="{{$search}}">
                            </form>
                        </div>
                        <ul class="article-list">
                            @foreach ($randoms as $item)
                                <li>
                                    <a href="{{ url('/schoolarship-details/'.$item->slug) }}" class="decoration-none">
                                        <h5 class="text-ellipsis-2">{{ $item->title }}</h5>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log">
                    <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                        <span class="fw-600 fp-white">Beasiswa</span>
                    </div>
                    <div class="report-table">
                        <div class="rounded-sm-top top-table-log border-bottom-none">
                            <h5 class="fp-black">Info Beasiswa</h5>
                        </div>
                        <div class="border-primary-grey rounded-sm-bottom p-25">
                            @if(count($schoolarships) > 0)
                                @foreach ($schoolarships as $item)
                                    <div class="article-item flex-center active flex-wrap">
                                        <div class="col-lg-2 col-sm-12 card-article-img">
                                            <img src="{{ $item->image != null ? asset($item->image) : asset('/guestAssets/img/article.jpg') }}" alt="">
                                        </div>
                                        <div class="col-lg-10 col-sm-12">
                                            <div class="d-flex align-start flex-column card-article-text">
                                                <small class="fs-10 mbottom-10">Tanggal Tautan : <b class="fs-10">{{ $item->created_at->format('d M Y') }}</b></small>
                                                <h5 class="mbottom-10">{{ $item->title }}</h5>
                                                <p class="text-ellipsis-2 mbottom-20 fw-400">{{ strip_tags($item->description) }}.</p>
                                                <a href="{{ url('/schoolarship-details/'.$item->slug) }}" class="decoration-none">
                                                    <div id="expand-news" class="fp-blue fw-700">Lihat Selengkapnya</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach         
                            @else
                            <div class="rounded-sm-bottom content-table-article flex-center m-auto">
                                <h5 class="fp-black m-auto fw-400">Belum Ada Beasiswa</h5>
                            </div>
                            @endif
                            <ul class="pagination">
                                @foreach($links as $item)
                                    <li class="{{$item['active'] ? 'active' : '' }}"> <a href="{{$item['url']}}">{!!$item['label']!!}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/schoolarship.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>