<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12 mbottom-15">
                <div class="side-menu-log p-15 border-primary-grey rounded-sm">
                    <h5 class="fp-black mbottom-5 text-center">Weekly Report</h5>
                    <h5 class="fp-black mbottom-15 fw-400 text-center" id="weekly_month_text"></h5>
                    <div class="row mbottom-30">
                        <div class="col-lg-12">
                            <ul class="report">
                                @foreach ($weeks as $item)
                                    <a href="{{ url('/weekly-report?week='.$item->week.'&month='.$item->week_date->format('F')) }}" class="decoration-none">
                                        <li>
                                            <div>
                                                <h5>Week {{ $item->week }}</h5>
                                                {{-- <h5>Week {{ $loop->iteration }}</h5> --}}
                                                <p>Status : 
                                                    {{ $item->reports == null ? 'Belum melapor' : ($item->approved_at == null ? 'Menunggu persetujuan' : 'Disetujui') }}
                                                </p>
                                            </div>
                                            <div class="ic-add-report {{ request()->get('week') != $item->week ? '' : 'active' }}"></div>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log shadow-mobile">
                    <div class="overflow-mobile">
                        <div class="table-responsive">
                            <div class="bg-primary-black flex-center-between flex-wrap top-black-table mbottom-30">
                                <div class="flex-center mbottom-15-mobile">
                                    <div class="flex-center">
                                        <img width="28" class="mright-10" src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                        <span class="fw-600">Weekly Report</span>
                                    </div>
                                    <span class="mleft-5 mright-5">|</span>
                                    <span id="weekly_month_text2">Januari</span>
                                </div>
                                <div id="select_month" class="select-custom --dark" data-id="select_month">
                                    <select id="weekly_month_filter" name="weekly_month_filter" class="selection">
                                        <option value="" id="monthly_filter_text" class="fp-white" disabled selected> -- Pilih Bulan -- </option>
                                        @foreach ($months as $item)
                                            <option class="fp-white" value="{{ $item }}" id="week_month"> {{ $item->month }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach ($datas as $item)
                            <div class="report-table">
                                <div class="flex-center-between rounded-sm-top top-table-log">
                                    <div class="flex-center mbottom-10-mobile">
                                        <b class="fp-black">Week {{ $item['week'] }}</b>
                                        <div class="fp-black">|</div>
                                        <span class="fp-black">{{ $item['range'] }}</span>
                                    </div>
                                    <div class="flex-center">
                                        <span class="mright-12">Approved</span>
                                        <div class="btn-approve bg-primary-grey flex-center p-10 rounded-sm fp-black mright-10 {{ $item['approved_by_lecturer'] ? 'approved' : '' }}">Dosen</div>
                                        <div class="btn-approve bg-primary-grey flex-center p-10 rounded-sm fp-black mright-20  {{ $item['approved_by_partner'] ? 'approved' : '' }}">Mitra</div>
                                        <div id="weekly_report"
                                            class="btn-report bg-primary-grey flex-center rounded-sm pointer {{ $item['weekly_report'] != null ? 'active' : '' }}" 
                                            data-id="{{ $item['week_id'] }}" 
                                            data-report="{{ $item['weekly_report'] }}"
                                            data-range="{{ $item['range'] }}"
                                            data-week="{{ $item['week'] }}"
                                            data-attachments = "{{ $item['attachments'] }}"
                                            data-dosen_approval="{{ $item['lecturer_approval'] }}"
                                            data-mitra_approval="{{ $item['mitra_approval'] }}"
                                            >Laporan
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-center title-table-log weekly">
                                    <div>Tanggal</div>
                                    <div>Clock In</div>
                                    <div>Clock Out</div>
                                    <div>Aktivitas</div>
                                    <div>Deskripsi</div>
                                </div>
                                @if (count($item['student_reports']) > 0)
                                    @foreach ($item['student_reports'] as $report)
                                        <div class="flex-center-between rounded-sm-bottom content-table-log weekly">
                                            <div>{{ $report->intern_date->format('Y/m/d') }}</div>
                                            @if ($report->attendance != null)
                                                <div>{{ $report->attendance->checkin != null ? $report->attendance->checkin->format('H:i:s') : '' }} WIB</div>
                                            @else 
                                            <div></div>
                                            @endif
                                            @if ($report->attendance != null)
                                                <div>{{ $report->attendance->checkout != null ? $report->attendance->checkout->format('H:i:s') : '' }} WIB</div>
                                            @else 
                                            <div></div>
                                            @endif
                                            <div>{{ $report->title }}</div>
                                            <div>
                                                <h5 class="text-ellipsis fw-400 fs-12 fp-black">
                                                    {{ Str::limit($report->reports, 50, '...') }}
                                                </h5>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="rounded-sm-bottom content-table-log flex-center m-auto">
                                        <h5 class="fp-black m-auto">Belum Ada Aktivitas</h5>
                                    </div>    
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('/custom/guest/weekly.js')}}" type="application/javascript" ></script>
</x-guest-layout>