<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12 mbottom-15-mobile">
                <div class="side-menu-log">
                    @if (Auth::user()->role == 'alumni')
                        <button class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15">Posting Beasiswa</button>
                    @endif
                    <div class="rounded-sm border-primary-grey pt-30 pb-30 pr-20 pl-20">
                        <h5 class="fp-black text-center mbottom-20">Cari Beasiswa</h5>
                        <div class="search-component mbottom-15">
                            <form action="/schoolarship">
                                <img width="20" src="{{ asset('/guestAssets/img/search.svg') }}" alt="">
                                <input class="w-100" placeholder="Cari Beasiswa" name="search" type="search">
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
                    <div class="table-responsive w-100-mobile">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                            <span class="fw-600 fp-white">Beasiswa</span>
                        </div>
                        <div class="report-table">
                            <div class="flex-center-between rounded-sm-top top-table-log border-bottom-none fixed-flex">
                                <h5 class="fp-black">Info Beasiswa</h5>
                                <a href="{{url()->previous()}}" class="decoration-none">
                                    <div class="flex-center">
                                        <img width="15" class="mright-5" src="{{ asset('/guestAssets/img/arrow-back.svg') }}" alt="">
                                        <h5 class="fp-black">Kembali</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="border-primary-grey rounded-sm-bottom p-25">
                                {{-- <div class="rounded-sm-bottom content-table-article flex-center m-auto">
                                <h5 class="fp-black m-auto fw-400">Belum Ada Beasiswa</h5>
                                </div> --}}
                                <div class="article-item flex-center details">
                                    <div class="col-lg-12 no-gutter card-article-img">
                                        <small class="fs-11">Tanggal Tautan : <b class="fs-10">{{ $data->created_at->format('d M Y') }}</b></small>
                                        <h5 class="mtop-5 mbottom-10">{{ $data->title }}</h5>
                                        @if ($data->image != null)
                                            <img class="banner no-rounded mbottom-15" src="{{ asset($data->image) }}" alt="">
                                        @endif
                                        <div class="article-description">
                                            {!! $data->description !!}
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
</x-guest-layout>