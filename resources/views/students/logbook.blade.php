<x-guest-layout>
    <div class="container logbook">
        <div class="row align-center mobile-none mbottom-25">
            <img class="mright-10" width="45" src="{{ asset('/guestAssets/img/ic-logbook.svg') }}" alt="">
            <h3 class="fw-700 title">Log Book</h3>
        </div>
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-4 col-sm-12">
                <div class="side-menu-log">
                    <div class="flex-center-between p-20 rounded-sm-top bg-primary-black">
                        <h5 class="fp-white" id="get_date"></h5>
                        <h5 class="fp-white fw-400" id="get_time"></h5>
                    </div>
                    <div class="row mbottom-30">
                        <div class="col-lg-6 col-clock" style="border-radius: 0 0 0 7px;">
                            <img width="60" class="logo-clock" src="{{ asset('/guestAssets/img/clockin.svg')}}" alt="">
                            <button id="clock_in" class="clock btn-rounded-lg primary {{ $attendance != null ? 'has-clock' : '' }}" {{ $attendance != null ? ($attendance->checkin != null ? 'disabled' : '') : '' }}>
                                <h5>Clock In</h5>
                                <img class="d-none blue-check" src="{{ asset('/guestAssets/img/check-blue.svg') }}" alt="">
                                <div class="d-none clock-time">
                                    {{ $attendance != null ? ($attendance->checkin != null ? ($attendance->checkin->format('H:i:s').' WIB') : '') : '' }}
                                </div>
                            </button>
                        </div>
                        <div class="col-lg-6 col-clock" style="border-radius: 0 0 7px 0; border-left:none;">
                            <img width="60" class="logo-clock" src="{{ asset('/guestAssets/img/clockout.svg') }}" alt="">
                            <button id="clock_out" class="clock btn-rounded-lg primary nowrap {{ $attendance != null ? ($attendance->checkout != null ? 'has-clock' : '') : '' }}" {{ $attendance != null ? ($attendance->checkout != null ? 'disabled' : '') : '' }}>
                                <h5>Clock Out</h5>
                                <img class="d-none blue-check" src="{{ asset('/guestAssets/img/check-blue.svg') }}" alt="">
                                <div class="d-none clock-time">
                                    {{ $attendance != null ? ($attendance->checkout != null ? ($attendance->checkout->format('H:i:s').' WIB') : '') : '' }}
                                </div>
                            </button>
                        </div>
                    </div>
                    @if ($attendance)
                        <button id="add_activity" 
                                data-date="{{ $current_report->intern_date->format('l, M Y') }}"
                                data-clock_in="{{ ($attendance->checkin->format('H:i:s').' WIB') }}"
                                data-reports=""
                                data-attachment=""
                                data-title=""
                                class="flex-center btn-add pointer rounded-sm {{ $current_report->title != null ? 'disabled' : '' }}" {{ $current_report->title != null ? 'disabled' : '' }}>
                            <h5>Tambahkan Activity</h5>
                            <h5 class="mleft-15 fw-300">{{ $current_report->intern_date->format('d/m/Y') }}</h5>
                        </button>
                    @endif
                </div>
            </div>
            <div class="main-menu-log col-lg-8 col-sm-12 overflow-mobile">
                <div class="flex-center-between rounded-sm-top top-table-log border-primary-grey pt-20 pb-20 pr-35 pl-35">
                    <h4 class="fp-black fs-20">Log Book</h4>                    
                    <div class="flex-center">
                        <div class="select-custom" data-id="select_month">
                            <select id="month_filter" name="month_filter" class="selection">
                                <option value="" disabled selected> -- Pilih Bulan -- </option>
                                @foreach ($months as $item)
                                    <option value="{{ $item->month }}"> {{ $item->month }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-mobile">
                    <div class="table-responsive">
                        <div class="flex-center title-table-log logbook">
                            <div>Tanggal</div>
                            <div>Clock In</div>
                            <div>Clock Out</div>
                            <div>Aktivitas</div>
                            <div>Status</div>
                            <div>Action</div>
                        </div>
                        @foreach ($data as $item)
                            <div class="flex-center rounded-sm-bottom content-table-log logbook">
                                <div>{{ $item->intern_date->format('d/m/Y') }}</div>
                                <div>
                                    @if ($item->attendance != null)
                                        @if ($item->attendance->checkin != null)
                                            <button class="btn-rounded-sm primary filled">{{ $item->attendance->checkin->format('H:i:s') }} WIB</button>  
                                        @endif
                                    @else
                                        <button class="btn-rounded-sm primary {{ $item->created_at == now() ? ' ' : 'disabled' }}" id="clock_in" {{ $item->created_at == now() ? '' : 'disabled' }}>Clock In</button>  
                                    @endif
                                </div>
                                <div>
                                    @if ($item->attendance != null)
                                        @if ($item->attendance->checkout != null)
                                            <button class="btn-rounded-sm primary filled">{{ $item->attendance->checkout->format('H:i:s') }} WIB</button>
                                        @else
                                            <button class="btn-rounded-sm primary">Clock Out</button>
                                        @endif
                                    @else
                                        <button class="btn-rounded-sm primary disabled" id="clock_out" disabled>Clock Out</button>
                                    @endif
                                </div> 
                                <div>
                                    <button 
                                    id="{{ $item->reports == '' ? 'add_activity' : 'show_activity' }}"
                                    data-id="{{ $item->id }}"
                                    data-title="{{ $item->title }}"
                                    data-reports="{{ $item->reports }}"
                                    data-attachment="{{ $item->attachment == null ? null : $item->attachment }}"
                                    data-date="{{ $item->intern_date->format('l, M Y') }}"
                                    data-clock_in="{{ $item->attendance == null ? 'belum clock in' 
                                                    : ($item->attendance->checkin == null ? 'belum clock in' 
                                                    : ($item->attendance->checkin->format('H:i:s').' WIB')) }}"
                                    data-dosen_approval="{{ $item->approval ? $item->approval : '' }}"
                                    data-mitra_approval="{{ $item->mitra_approval ? $item->mitra_approval : '' }}"
                                    class="btn-rounded-sm primary {{ $item->title != null ? 'filled' : ($item->intern_date->format('d/m/y') == now()->format('d/m/y') ? '' : 'disabled') }}"
                                    {{ $item->intern_date->format('d/m/y') == now()->format('d/m/y') ? '' : 'disabled' }}>{{ $item->title != null ? $item->title : 'Tambahkan Activity' }}</button>
                                </div>
                                <div>{{ $item->approved_at == null ? 'Menunggu konfirmasi' : 'Disetujui' }}</div>
                                <div>
                                    <button class="btn-rounded-sm primary {{ $item->intern_date <= now() ? 'btn-view' : 'disabled' }}" 
                                            id="{{ $item->intern_date <= now() ? 'show_activity' : 'add_activity' }}"
                                            data-id="{{ $item->id }}"
                                            data-title="{{ $item->title }}"
                                            data-reports="{{ $item->reports }}"
                                            data-attachment="{{ $item->attachment == null ? null : $item->attachment }}"
                                            data-date="{{ $item->intern_date->format('l, M Y') }}"
                                            data-clock_in="{{ $item->attendance == null ? 'belum clock in' 
                                                            : ($item->attendance->checkin == null ? 'belum clock in' 
                                                            : ($item->attendance->checkin->format('H:i:s').' WIB')) }}"
                                            data-dosen_approval="{{ $item->approval ? $item->approval : '' }}"
                                            data-mitra_approval="{{ $item->mitra_approval ? $item->mitra_approval : '' }}"
                                            {{ $item->intern_date <= now() ? '' : 'disabled' }}>Lihat
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzmtVA4dPSrfaGv9LgyEi-fGNcdsyGc4w"
        defer
      ></script>
        <script src="{{url('/custom/guest/logbook.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>
