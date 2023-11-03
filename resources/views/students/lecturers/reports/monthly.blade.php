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
                <div class="mtop-20 pointer mbottom-10-mobile">
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
                                    <h4 class="fp-black fs-20">Monthly Report</h4>
                                </div>
                                <div class="flex-center title-table-log weekly-lecturer">
                                    <div>Date</div>
                                    <div>Month</div>
                                    <div>Dosen</div>
                                    <div>Mitra</div>
                                    <div>Status</div>
                                    <div>Action</div>
                                </div>
                                @foreach ($data as $item)
                                    <div class="flex-center rounded-sm-bottom content-table-log weekly-lecturer">
                                        <div>{{ $item->month_date->format('d/m/Y') }}</div>
                                        <div>{{ $item->month }}</div>
                                        <div>
                                            {{ $item->approved_by_lecturer ? 'approved' : '' }}
                                        </div>
                                        <div>{{ $item->approved_by_partner ? 'approved' : '' }}</div>
                                        <div>{{ $item->approved_at == null ? ($item->reports != null ? 'Menunggu konfirmasi' : 'Belum mengisi') : 'Disetujui' }}</div>
                                        <div>
                                            <button class="btn-rounded-sm primary btn-view" 
                                                    id="show_detail_report_weekly"
                                                    data-id="{{ $item->id }}"
                                                    data-approval_id="{{ $item->approval == null ? '' : $item->approval->id }}"
                                                    data-mitra_approval_id="{{ $item->mitra_approval == null ? '' : $item->mitra_approval->id }}"
                                                    data-notes="{{ $item->approval == null ? '' : $item->approval->notes }}"
                                                    data-mitra_notes="{{ $item->mitra_approval == null ? '' : $item->mitra_approval->notes }}"
                                                    data-month="{{ $item->month }}"
                                                    data-reports="{{ $item->reports }}"
                                                    data-attachment="{{ $item->attachment == null ? '' : $item->attachment }}">Lihat
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
