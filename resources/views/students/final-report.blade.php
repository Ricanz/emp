<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 mbottom-30 col-sm-12">
                <div class="side-menu-log p-15 border-primary-grey rounded-sm">
                    <h5 class="fp-black mbottom-5 text-center">Rubrik Penilaian</h5>
                    <h5 class="fp-black text-center mtop-35 mbottom-35 fw-400"></h5>
                    @if ($rubrik_dosen !== null)
                        <a href="{{ url( '/'.$rubrik_dosen->file) }}" target="_blank" style="text-decoration: none">
                            <div class="flex-center btn-square-sm primary pointer mleft-auto mbottom-10">Penilaian Dosen</div>
                        </a>
                    @else
                         <div class="flex-center btn-square-sm primary pointer mleft-auto mbottom-10 disabled">Belum Ada Penilaian Dosen</div>
                    @endif
                    @if ($rubrik_mitra !== null)
                        <a href="{{ url( '/'.$rubrik_mitra->file) }}" target="_blank" style="text-decoration: none">
                            <div class="flex-center btn-square-sm primary pointer mleft-auto mbottom-10">Penilaian Mitra</div>
                        </a>
                    @else
                        <div class="flex-center btn-square-sm primary pointer mleft-auto mbottom-10 disabled">Belum Ada Penilaian Mitra</div>
                    @endif
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log shadow-mobile">
                    <div class="overflow-mobile">
                        <div class="table-responsive">
                            <div class="bg-primary-black top-black-table flex-center mbottom-30">
                                <img width="28" class="mright-10" src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                <span class="fw-600">Laporan Akhir</span>
                            </div> 
                            <div class="bg-secondary-grey border-primary-grey flex-center pt-15 pb-15 pl-25 pr-35 rounded-sm mbottom-10">
                                <img width="35" src="{{ asset('/guestAssets/img/ic-warning.svg') }}" alt="">
                                <h5 class="fp-black pl-15 w-70 fw-400">Diberitahukan kepada semua mahasiswa yang mengikuti magang, untuk melaporkan tugas akhir magang dengan form terlampir</h5>
                                {{-- <a href="{{ url('/'.$form->file) }}" target="_blank" class="decoration-none mleft-auto">
                                    <div class="flex-center btn-square-sm primary pointer">Download Form</div>
                                </a> --}}

                                @if (isset($final_report->attachment))
                                    <a href="{{ asset($final_report->attachment->file) }}" class="decoration-none mleft-auto" target="_blank">
                                        <div id="monthly_report" class="flex-center btn-square-sm primary pointer mleft-auto">Download Laporan</div>
                                    </a>
                                @else
                                    <h5 class="fp-black text-center mtop-35 mbottom-35 fw-400">Belum ada laporan!</h5>
                                @endif
                            </div>
                            <div class="report-table">
                                <div class="flex-center-between rounded-sm-top top-table-log">
                                    <b class="fp-black mbottom-10-mobile">Laporan Akhir</b>
                                    <div id="final_report" class="btn-report bg-primary-grey flex-center rounded-sm pointer {{ isset($final_report->attachment) ? 'active' : '' }}"
                                        data-id="{{ $final_report ? $final_report->id : '' }}"
                                        data-report="{{ $final_report ? $final_report->reports : '' }}"
                                        data-attachment="{{ $final_report ? ($final_report->attachment != null ? $final_report->attachment->file : '') : '' }}">Laporan</div>
                                </div>
                                <div class="flex-center title-table-log final">
                                    <div>Bulan</div>
                                    <div>Deskripsi</div>
                                    <div>Catatan Dosen</div>
                                    <div>Catatan Mitra</div>
                                    <div>Status</div>
                                </div>
                                @if (count($monthly_reports) > 0)
                                    @foreach ($monthly_reports as $item)
                                        <div class="flex-center rounded-sm-bottom content-table-log final">
                                            <div>{{ $item->month }}</div>
                                            <div><h5 class="text-ellipsis">{{ $item->reports == null ? 'Belum ada' : $item->reports }}</h5></div>
                                            <div><h5 class="text-ellipsis">{{ $item->approval == null ? 'Belum ada' : $item->approval->notes }}</h5></div>
                                            <div><h5 class="text-ellipsis">{{ $item->mitra_approval == null ? 'Belum ada' : $item->mitra_approval->notes }}</h5></div>
                                            <div>{{ $item->approved_at == null ? ($item->reports == null ? 'Belum Melapor' : 'Sudah Melapor') : 'Disetujui' }}</div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex-center rounded-sm-bottom content-table-log empty w-100">
                                        <h5 class="fp-black fw-400 fs-13 m-auto">Belum Ada Aktivitas</h5>
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
        <script src="{{url('/custom/guest/final.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>