<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="card border-primary-grey rounded-sm profile">
                    <img class="profile125" src="{{ asset($student->image) }}" alt="">
                    <div class="flex-center-between mtop-20">
                        <h5>Nama</h5>
                        <h5 class="fw-400">{{ $student->name }}</h5>
                    </div>
                    <div class="border2-secondary-grey mtop-10 mbottom-10 m-auto w-100 rounded-sm"></div>
                    <div class="flex-center-between mtop-20">
                        <h5>Jenis</h5>
                        <h5 class="fw-400">{{ $student->jenis }}</h5>
                    </div>
                    <div class="border2-secondary-grey mtop-10 mbottom-10 m-auto w-100 rounded-sm"></div>
                    <div class="text-center mtop-10">
                        <h5 class="fw-400">{{ $student->email }}</h5>
                    </div>
                    <div class="border-bottom-profile"></div>
                </div>
                <div class="mtop-20 pointer">
                    <a href="{{ url('/lecturer/students/final/'.$student->nim) }}" class="decoration-none">
                        <div class="card-black">
                            <img src="{{ asset('/guestAssets/img/report.svg') }}" alt="">
                            <span>Final Report</span>
                        </div>
                    </a>
                </div>
                <div class="mtop-20 pointer">
                    <a href="{{ url('/lecturer/students/assignment/'.$student->nim) }}" class="decoration-none">
                        <div class="card-black">
                            <img src="{{ asset('/guestAssets/img/report.svg') }}" alt="">
                            <span>Tugas</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12 no-gutter-mobile">
                <div class="row flex-center-between mbottom-20 flex-wrap">
                    <div class="col-lg-4 col-sm-12 pointer mtop-20-mobile">
                        <a href="{{ url('/lecturer/students/details/'.$student->nim) }}" class="decoration-none">
                            <div class="card-black">
                                <img src="{{ asset('/guestAssets/img/report.svg') }}" alt="">
                                <span>Logbook</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-12 pointer mtop-20-mobile">
                        <a href="{{ url('/lecturer/students/weekly/'.$student->nim) }}" class="decoration-none">
                            <div class="card-black">
                                <img src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                <span>Weekly Report</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-12 pointer mtop-20-mobile">
                        <a href="{{ url('/lecturer/students/monthly/'.$student->nim) }}" class="decoration-none">
                            <div class="card-black">
                                <img src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                <span>Monthly Report</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row flex-center-between mbottom-20">
                    <div class="main-menu-log w-100 shadow-mobile">
                        <div class="overflow-mobile">
                            <div class="table-responsive">
                                <div class="flex-center-between rounded-sm-top top-table-log">
                                    <h4 class="fp-black fs-20">Log Book Mahasiswa</h4>
                                </div>
                                <div class="flex-center title-table-log logbook">
                                    <div>Date</div>
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
                                            <button id="add_activity" 
                                            data-clock_in="{{ $item->attendance == null ? ' ' :  ($item->attendance->checkin  == null ? ' ' : ($item->attendance->checkin->format('H:i:s').' WIB')) }}" class="btn-rounded-sm primary {{ $item->title != null ? 'filled' : 'disabled' }}" disabled>{{ $item->title != null ? $item->title : 'Belum mengisi' }}</button>
                                        </div>
                                        <div>{{ $item->approved_at == null ? ($item->title != null ? 'Menunggu konfirmasi' : 'Belum mengisi') : 'Disetujui' }}</div>
                                        <div>
                                            <button class="btn-rounded-sm primary btn-view" 
                                                    id="show_detail_report"
                                                    data-id="{{ $item->id }}"
                                                    data-title="{{ $item->title }}"
                                                    data-reports="{{ $item->reports }}"
                                                    data-attachment="{{ $item->attachment == null ? null : $item->attachment }}"
                                                    data-date="{{ $item->intern_date->format('l, M Y') }}"
                                                    data-approval_id = "{{ $item->approval == null ? '' : $item->approval->id }}"
                                                    data-mitra_approval_id = "{{ $item->mitra_approval == null ? '' : $item->mitra_approval->id }}"
                                                    data-mitra_notes = "{{ $item->mitra_approval == null ? '' : $item->mitra_approval->notes }}"
                                                    data-notes = "{{ $item->approval == null ? '' : $item->approval->notes }}"
                                                    data-clock_in="{{ $item->attendance == null ? 'belum clock in' 
                                                                    : ($item->attendance->checkin == null ? 'belum clock in' 
                                                                    : ($item->attendance->checkin->format('H:i:s').' WIB')) }}">Lihat
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
    @section('scripts')
        <script src="{{url('/custom/guest/lecturer.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>
