<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="side-menu-log">
                    @if(Auth::user()->role == 'alumni')
                        <button  class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15" id="post_job">Posting Lowongan</button>
                    @endif
                    <div class="rounded-sm border-primary-grey pt-30 pb-30 pr-20 pl-20 mbottom-30">
                        <h5 class="fp-black text-center mbottom-20">Cari Lowongan</h5>
                        <form action="">
                        <div class="search-component mbottom-15">
                            <img width="20" src="{{ asset('/guestAssets/img/search.svg') }}" alt="">
                            <input class="w-100" placeholder="Cari Lowongan" type="search" name="search" value="{{$search}}">
                        </div>
                        <div class="select-custom --grey mbottom-20" data-id="item_location">
                            <select id="location" name="location" class="selection">
                                <option value="0"> Pilih Lokasi </option>
                                @foreach($locations as $item)
                                    <option value="{{$item->id}}" {{$item->id == $location ? 'selected' : ''}}> {{$item->location}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-custom --grey mbottom-20" data-id="item_location">
                            
                            <select id="location" name="category" class="selection">
                                <option value="0"  {{!$category ? 'selected' : ''}} >Semua Kategori </option>
                                <option value="5"  {{ '5' == $category ? 'selected' : ''}}>Full Time</option>
                                <option value="7"  {{ '7' == $category ? 'selected' : ''}}>Part Time</option>
                                <option value="6"  {{ '6'== $category ? 'selected' : ''}}>Freelance</option>
                            </select>
                        </div>
                        <button class="btn-rounded-lg primary w-100">Cari</button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log">
                    <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                        <span class="fw-600 fp-white">Lowongan Kerja</span>
                    </div>
                    <div class="report-table">
                        <div class="flex-center-between rounded-sm-top top-table-log border-bottom-none">
                            <h5 class="fp-black">Lowongan Kerja Terbaru - Semua Kategori</h5>
                        </div>
                        <div class="border-primary-grey rounded-sm-bottom p-25">
                            @if (count($jobs) > 0)
                                @foreach ($jobs as $item)
                                <div class="article-item flex-center-between">
                                    <div class="flex-center col-lg-9 col-sm-12 flex-wrap">
                                        <div class="col-lg-2 col-sm-12 card-article-img">
                                            <img src="{{ $item->image == null ? asset('/guestAssets/img/dummy-logo.svg') : asset($item->image) }}" alt="">
                                        </div>
                                        <div class="col-lg-10 col-sm-12 d-flex align-start flex-column card-article-text">
                                            <p class="fp-secondary-grey fs-11 mbottom-10">{{ $item->end_date->format('d M Y') }}</p>
                                            <h5 class="fw-400">{{ $item->locat->location ?? '' }}</h5>                                            
                                            <a href="{{ url('/job-vacancy-details/'.$item->slug) }}" class="decoration-none fp-black">
                                                <h5 class="mbottom-5">{{ $item->title }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <div class="rounded-sm-bottom content-table-article flex-center m-auto">
                                    <h5 class="fp-black m-auto fw-400">Belum Ada Lowongan Kerja</h5>
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
        <script src="{{url('/custom/guest/job-vacancy.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>

<style>
</style>