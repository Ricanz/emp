<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-12 col-sm-12">
                <div class="main-menu-log shadow-mobile">
                    <div class="overflow-mobile">
                        <div class="table-responsive">
                            <div class="bg-primary-black top-black-table flex-center mbottom-30">
                                <img width="28" class="mright-10" src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                <span class="fw-600">Rubrik Penilaian</span>
                            </div> 
                            <div class="bg-secondary-grey border-primary-grey flex-center pt-15 pb-15 pl-25 pr-35 rounded-sm mbottom-10">
                                <img width="35" src="{{ asset('/guestAssets/img/ic-warning.svg') }}" alt="">
                                <h5 class="fp-black pl-15 w-70 fw-400">Silahkan download form penilaian akhir mahasiswa pada tombol di samping tulisan ini.</h5>
                                <a href="{{ url('/'.($form != null ? $form->file : '')) }}" class="decoration-none mleft-auto" target="_blank">
                                    <div class="flex-center btn-square-sm primary pointer mleft-auto">Download Form</div>
                                </a>
                                {{-- <a href="{{ url('/'.$form->file) }}" target="_blank" class="decoration-none mleft-auto">
                                    <div class="flex-center btn-square-sm primary pointer">Download Form</div>
                                </a> --}}

                                {{-- @if (isset($final_report->attachment))
                                    <a href="{{ asset($final_report->attachment->file) }}" class="decoration-none mleft-auto" target="_blank">
                                        <div id="monthly_report" class="flex-center btn-square-sm primary pointer mleft-auto">Download Laporan</div>
                                    </a>
                                @else --}}
                                    {{-- <h5 class="fp-black text-center mtop-35 mbottom-35 fw-400">Belum ada laporan!</h5> --}}
                                {{-- @endif --}}
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
                                                            <a class="btn-rounded-sm primary decoration-none" href="{{ url('/lecturer/students/final/'.$item->nim) }}">Kirim Nilai</a>
                                                        </div>
                                                    </div>
                                                @endforeach
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
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/final.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>