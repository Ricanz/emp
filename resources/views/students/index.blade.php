<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap bottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="card border-primary-grey rounded-sm profile">
                    <img class="profile125" src="{{ $student->image == null ? '/guestAssets/img/pic.png' : asset($student->image) }}" onerror="this.onerror=null; this.src='storage/mentor/1669619448.jpg'" alt="">
                    <div class="flex-center-between mtop-20">
                        <h5>Nama</h5>
                        <h5 class="fw-400">{{ $student->name }}</h5>
                    </div>
                    <div class="border2-secondary-grey mtop-10 mbottom-10 m-auto w-100 rounded-sm"></div>
                    <div class="flex-center-between mtop-20">
                        <h5>NIM</h5>
                        <h5 class="fw-400">{{ $student->nim }}</h5>
                    </div>
                    <div class="border2-secondary-grey mtop-10 mbottom-10 m-auto w-100 rounded-sm"></div>
                    <div class="text-center mtop-10">
                        <h5 class="fw-400">{{ $student->email }}</h5>
                    </div>
                    <div class="border-bottom-profile bg-primary-white mobile-none"></div>
                </div>
                <a class="btn-square-md-mobile white border-primary-darkgrey w-100 mtop-20 mbottom-20 p-12 decoration-none mobile-display text-center" href="{{route('logout')}}">
                    <span class="mright-10">Logout</span>
                    <img width="15" src="{{ asset('/guestAssets/img/logout.svg') }}" alt="">
                </a>
            </div> 
            <div class="col-lg-9 col-sm-12 mobile-none">
                <div class="row flex-center-between mbottom-20">
                    <div class="col-lg-4 pointer">
                        <a href="{{ url('/weekly-report?week='.\App\Helpers\Utils::get_current_week(now()->format('m')).'&month='.now()->format('F')) }}" class="decoration-none">
                            <div class="card-black">
                                <img src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                <span>Weekly Report</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 pointer" id="_to_monthly_report_">
                        <div class="card-black">
                            <img src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                            <span>Monthly Report</span>
                        </div>
                    </div>
                    <div class="col-lg-4 pointer" id="_to_final_report_">
                        <div class="card-black">
                            <img src="{{ asset('/guestAssets/img/report.svg') }}" alt="">
                            <span>Laporan Akhir</span>
                        </div>
                    </div>
                </div>
                <div class="row flex-center-between mbottom-20">
                    <div class="col-lg-3">
                        <div class="card border-primary-grey rounded-sm program">
                            <img width="90" src="{{ asset('/guestAssets/img/ic-learning.svg') }}" alt="">
                            <span>Learning Plan</span>
                        </div>
                    </div>
                    <div class="col-lg-3 pointer" id="_to_daily_report_">
                        <div class="card border-primary-grey rounded-sm program">
                            <img width="80" src="{{ asset('/guestAssets/img/ic-logbook.svg') }}" alt="">
                            <span>Log Book</span>
                        </div>
                    </div>
                    <div class="col-lg-3 pointer" id="_to_assignment_">
                        <div class="card border-primary-grey rounded-sm program">
                            <img width="70" src="{{ asset('/guestAssets/img/ic-assignment.svg') }}" alt="">
                            <span>Tugas</span>
                        </div>
                    </div>
                    <div class="col-lg-3" id="_to_qna_">
                        <div class="card border-primary-grey rounded-sm program">
                            <img width="80" src="{{ asset('/guestAssets/img/ic-qna.svg') }}" alt="">
                            <span>Tanya Jawab</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>