<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12 mbottom-15">
                <div class="side-menu-log p-15 border-primary-grey rounded-sm">
                    <h5 class="fp-black mbottom-5 text-center">Monthly Report</h5>
                    <h5 class="fp-black mbottom-15 fw-400 text-center arrow-after">{{ $current_month }}</h5>
                    <div class="row mbottom-30">
                        <div class="col-lg-12">
                            <ul class="report">
                                @foreach ($months as $item)
                                <a href="{{ url('monthly-report?month=').$item->month }}" class="decoration-none">
                                    <li>
                                        <div>
                                            <h5>{{ $item->month }}</h5>
                                            <p>Status : {{ $item->reports == null ? 'Belum Melapor' : ($item->approved_at == null ? 'Menunggu Persetujuan' : 'Disetujui') }}</p>
                                        </div>
                                        <div class="ic-add-report {{ request()->get('month') != $item->month ? '' : 'active' }}"></div>
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
                            <div class="bg-primary-black flex-center-between top-black-table mbottom-30">
                                <div class="flex-center">
                                    <img width="28" class="mright-10" src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                    <span class="fw-600">Monthly Report</span>
                                    <span class="mleft-5 mright-5">|</span>
                                    <span>{{ $current_month }}</span>
                                </div>
                                <div id="select_month" class="select-custom --dark" data-id="select_month">
                                    <select id="monthly_filter" name="mothly_month_filter" class="selection">
                                        <option value="" id="monthly_filter_text" class="fp-white" disabled selected> -- Pilih Bulan -- </option>
                                        @foreach ($moonths as $item)
                                            <option class="fp-white" value="{{ $item->month }}" id="week_month"> {{ $item->month }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            @foreach ($datas as $item)
                                <div class="report-table">
                                    <div class="flex-center-between rounded-sm-top top-table-log">
                                        <b class="fp-black mbottom-10-mobile">{{ $item['month'] }}</b>
                                        <div class="flex-center">
                                            <span class="mright-12">Approved</span>
                                            <div class="btn-approve bg-primary-grey flex-center p-10 rounded-sm fp-black mright-10 {{ $item['approved_by_lecturer'] ? 'approved' : '' }}">Dosen</div>
                                            <div class="btn-approve bg-primary-grey flex-center p-10 rounded-sm fp-black mright-20  {{ $item['approved_by_partner'] ? 'approved' : '' }}">Mitra</div>
                                            
                                            <div id="monthly_report" class="btn-report bg-primary-grey flex-center rounded-sm pointer {{ $item['monthly_reports'] != null ? 'active' : '' }}"
                                                data-id="{{ $item['month_id'] }}" 
                                                data-report="{{ $item['monthly_reports'] }}"
                                                {{-- data-range="{{ $item['range'] }}" --}}
                                                data-month="{{ $item['month'] }}"
                                                data-attachments = "{{ $item['attachments'] }}"
                                                data-dosen_approval = "{{ $item['lecturer_approval'] }}"
                                                data-mitra_approval = "{{ $item['mitra_approval'] }}"
                                                >Laporan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-center title-table-log monthly">
                                        <div>Week</div>
                                        <div>Deskripsi</div>
                                        <div>Catatan Dosen</div>
                                        <div>Catatan Mitra</div>
                                        <div>Status</div>
                                    </div>
                                    @if (count($item['weekly_reports']))
                                    @foreach ($item['weekly_reports'] as $week)
                                        <div class="flex-center-between rounded-sm-bottom content-table-log monthly">
                                            <div class="d-block monthly-date">
                                                <h5>Week {{ $week->week }}</h5>
                                                <h5>1 - 7 Jan 2023</h5>
                                            </div> 
                                            <div><h5 class="text-ellipsis">{{ $week->reports }}</h5></div>
                                            @if ($week->approval)
                                                <div><h5 class="text-ellipsis">{{ $week->approval->notes }}</h5></div>
                                            @else 
                                                <div><h5 class="text-ellipsis"></h5></div>
                                            @endif
                                            <div><h5 class="text-ellipsis">{{ $week->mitra_approval ? $week->mitra_approval->notes : '' }}</h5></div>
                                            <div><h5 class="text-ellipsis">
                                                {{ $week->approved_at == null ? 'Belum diperiksa' : 'Melapor' }}
                                            </h5></div>
                                        </div>
                                    @endforeach
                                    @else
                                        <div class="rounded-sm-bottom flex-center m-auto content-table-log">
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
    </div>
    <script src="{{url('/custom/guest/monthly.js')}}" type="application/javascript" ></script>
</x-guest-layout>