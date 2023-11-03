<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="side-menu-log">
                    <div class="rounded-sm border-primary-grey pt-30 pb-30 pr-20 pl-20 mbottom-30">
                        <h5 class="fp-black text-center mbottom-20">Filter Pencarian</h5>
                        <form action="" id="alumni_name_filter">
                            <div class="search-component mbottom-15">
                                <img width="20" src="{{ asset('/guestAssets/img/search.svg') }}" alt="">
                                <input class="w-100" placeholder="Pencarian Alumni" name="alumni_name" id="alumni_name" type="search">
                            </div>
                        </form>
                        <div class="select-custom --grey mbottom-15" data-id="select_year">
                            <select id="alumni_year_filter" name="alumni_year_filter" class="selection">
                                <option value="" disabled selected> --Pilih Tahun--</option>
                                @foreach ($years as $item)
                                    <option value="{{ $item->year }}"> {{ $item->year }}</option>  
                                @endforeach
                            </select>
                        </div>
                        <button class="btn-rounded-lg primary w-100">Cari</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log shadow-mobile">
                    <div class="overflow-mobile">
                        <div class="table-responsive">
                            <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                                <span class="fw-600 fp-white">Daftar Alumni</span>
                            </div>
                            <div class="report-table">
                                <div class="flex-center-between rounded-sm-top top-table-log border-bottom-none">
                                    <h5 class="fp-black mbottom-10-mobile">Daftar Alumni | <span class="fw-400">{{ now()->format('Y') }}</span></h5>
                                    <div class="flex-center">
                                        <h5 class="fp-black mright-5">Urutkan</h5>
                                        <div class="select-custom" data-id="sort_by">
                                            <select id="alumni_filter" name="alumni_filter" class="selection">
                                                <option value="" disabled selected> --Pilih Filter--</option>
                                                <option value="newest"> Terbaru</option>
                                                <option value="abjad"> Abjad</option>
                                                <option value="year"> Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="rounded-sm-bottom">
                                    <div class="flex-center title-table-log alumni-column">
                                        <div>Foto</div>
                                        <div>Nama</div>
                                        <div>Fakultas</div>
                                        <div>Jurusan</div>
                                        <div>Tahun Lulus</div>
                                        <div>Riwayat Pekerjaan</div>
                                    </div>
                                    @if (count($alumni) > 0)
                                        @foreach ($alumni as $item)
                                            <div class="flex-center-between rounded-sm-bottom content-table-log alumni-column">
                                                <div id="btn_preview_img" class="pointer">
                                                    <img src="{{ asset($item->image) }}" alt="your image" />
                                                </div>
                                                <div>{{ $item->name }}</div>
                                                <div>{{ $item->faculty }}</div>
                                                <div>{{ $item->major }}</div>
                                                <div>{{ $item->year_graduate }}</div>
                                                <div><button class="btn-rounded-sm primary" 
                                                        id="show_detail_alumni"
                                                        data-history="{{ $item->history }}"
                                                        data-name="{{ $item->name }}"
                                                        data-nim="{{ $item->phone }}"
                                                        data-image="{{ $item->image == null ? '/guestAssets/img/pic.png' : $item->image }}">Selengkapnya
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="flex-center rounded-sm-bottom content-table-log m-auto">
                                        <h5 class="fp-black m-auto fw-400">Belum Ada Daftar Alumni</h5>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/alumni.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>