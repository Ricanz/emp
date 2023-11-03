<x-guest-layout>
    <div class="container">
        <div class="row mbottom-30 mbottom-5-mobile">
            <div class="col-lg-12 flex-center-between flex-wrap">
                <div class="flex-center mbottom-10-mobile">
                    <img class="mright-10" width="45" src="{{ asset('/guestAssets/img/ic-logbook.svg') }}" alt="">
                    <h3 class="fw-700 title">Tugas Mahasiswa</h3>
                </div>
            </div>
        </div>
        <div class="row mbottom-100">
            <div class="col-lg-12">
                <div class="main-menu-log">
                    <div class="flex-center-between rounded-sm-top top-table-log">
                        <h4 class="fp-black fs-20">Data Mahasiswa</h4>
                        <div id="lecturer_create_assignment" class="flex-center btn-square-sm primary pointer mleft-auto">Tambah Tugas</div>
                    </div>
                    <div class="overflow-mobile">
                        <div class="table-responsive">
                            <div class="flex-center title-table-log assign-lecturer">
                                <div>File</div>
                                <div>Judul</div>
                                <div>Deskripsi</div>
                                <div>Student</div>
                                <div>Start Date</div>
                                <div>End Date</div>
                                <div>Action</div>
                            </div>
                            @if (count($tasks) > 0)
                                @foreach ($tasks as $item)
                                    <div class="flex-center rounded-sm-bottom content-table-log assign-lecturer">
                                        <div>
                                            <a href="{{ url('/'.$item->image) }}" target="_blank" class="pointer decoration-none">download assignment</a>
                                            {{-- <img class="mright-35 rounded-sm" width="45" src="{{ asset($item->image) }}" alt=""> --}}
                                        </div>
                                        <div>{{ $item->title }}</div>
                                        <div>{{ Str::limit($item->description, 20, '...') }}</div>
                                        <div>{{ $item->student->name }}</div>
                                        <div>{{ $item->start_date->format('d/mY') }}</div>
                                        <div>{{ $item->end_date->format('d/m/Y') }}</div>
                                        <div>
                                            <a class="btn-rounded-sm primary decoration-none" href="{{ url('/lecturer/students/assignment/'.$item->student->nim) }}">Lihat</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex-center rounded-sm-bottom content-table-log empty w-100">
                                    <h5 class="fp-black m-auto fs-13 fw-400">Tugas Belum Ditambahkan</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/lecturer.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>
