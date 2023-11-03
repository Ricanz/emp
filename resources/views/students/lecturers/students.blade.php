<x-guest-layout>
    <div class="container">
        <div class="row mbottom-30 mbottom-5-mobile">
            <div class="col-lg-12 flex-center-between flex-wrap">
                <div class="flex-center mbottom-10-mobile">
                    <img class="mright-10" width="45" src="{{ asset('/guestAssets/img/ic-logbook.svg') }}" alt="">
                    <h3 class="fw-700 title">Data Mahasiswa</h3>
                </div>
                <div class="flex-center">
                    <p class="fp-black mright-10">Search Field</p>
                    <form action="" id="search_student">
                        <div class="search-component">
                            <img width="20" src="{{ asset('/guestAssets/img/search.svg') }}" alt="">
                            <input type="search" name="name">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mbottom-100">
            <div class="col-lg-12">
                <div class="main-menu-log overflow-mobile">
                    <div class="flex-center-between rounded-sm-top top-table-log">
                        <h4 class="fp-black fs-20">Data Laporan Mahasiswa</h4>
                    </div>
                    <div class="overflow-mobile">
                        <div class="table-responsive">
                            <div class="flex-center title-table-log students">
                                <div>Foto</div>
                                <div>Nama</div>
                                <div>Mitra</div>
                                <div>Action</div>
                            </div>
                            @foreach ($students as $item)
                                <div class="flex-center rounded-sm-bottom content-table-log students">
                                    <div>
                                        <img class="mright-35 rounded-sm" width="45" src="{{ asset($item->image) }}" alt="">
                                    </div>
                                    <div>{{ $item->name }}</div>
                                    <div>{{ $item->mitra->name }}</div>
                                    <div>
                                        <a class="btn-rounded-sm primary decoration-none" href="{{ url('/lecturer/students/details/'.$item->nim) }}">Lihat</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/logbook.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>
