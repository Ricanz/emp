<nav>
    <div class="navbar-collapse">
        <div class="top-section">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img class="logo" src="{{ asset('/guestAssets/img/mknows.png') }}" alt="">
                    <span class="fw-700 mobile-none">M-Knows Consulting</span>
                </a>
                <div class="profile-nav dropdown mobile-none">
                    <img class="user-profile" src="{{ \App\Helpers\Utils::user()->name != null ? asset(\App\Helpers\Utils::user()->image) : asset('/guestAssets/img/pic.png') }}" alt="">
                    <p class="text-ellipsis">{{ \App\Helpers\Utils::user()->name }}</p>
                    <div class="dropdown-menu profile">
                        @if (Auth::user()->role == 'student')
                            <a class="dropdown-item" href="/">Profile</a>
                            {{-- <a class="dropdown-item" href="#">Learning Plan</a> --}}
                            <a class="dropdown-item" href="{{ url('/log-book') }}">Log Book</a>
                            <a class="dropdown-item" href="{{ url('/assignment') }}">Tugas</a>
                            <a class="dropdown-item" href="{{ url('/qna') }}">Tanya Jawab</a>
                            <a class="dropdown-item" href="{{ url('/weekly-report?week='.\App\Helpers\Utils::get_current_week(now()->format('m')).'&month='.now()->format('F')) }}">Weekly Report</a>
                            <a class="dropdown-item" href="{{ url('/monthly-report?month='.now()->format('F')) }}">Monthly Report</a>
                            <a class="dropdown-item" href="{{ url('/final-report') }}">Laporan Akhir</a>
                        @elseif(Auth::user()->role == 'lecturer')
                        <a class="dropdown-item" href="/lecturer/home">Profile</a>
                        <a class="dropdown-item" href="{{ url('/lecturer/students') }}">Mahasiswa</a>
                        <a class="dropdown-item" href="{{ \App\Helpers\Utils::isMentor(Auth::user()->id) ? url('/lecturer/assignments') : url('/lecturer/students') }}">Tugas</a>
                            @if (\App\Helpers\Utils::isLecturer(Auth::user()->id))
                                <a class="dropdown-item" href="{{ url('/qna') }}">Tanya Jawab</a>
                            @endif
                        @endif
                        
                        <a class="dropdown-item logout" href="{{route('logout')}}">
                            <span class="mright-10">Logout</span>
                            <img width="15" src="{{ asset('/guestAssets/img/logout.svg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="nav-mobile">
                    <div class="flex-center justify-right h-100">
                        @if (Auth::user()->role == 'student')
                            <div id="side_report" class="container-menu"><div class="mobile-menu report-menu"></div></div>
                            <img class="line" src="{{ asset('guestAssets/img/line.svg') }}" alt="">
                        @endif
                        <div id="side_profile" class="container-menu h-100"><div class="mobile-menu profile-menu"></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-section mobile-none">
            <div class="container">
                <ul class="nav-section">
                    <li class="nav-item dropdown">
                        Info Kampus
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/info/campus/lesson') }}">Alumni Mengajar</a>
                            <a class="dropdown-item" href="{{ url('/info/campus/advanced') }}">Studi Lanjut</a>
                            <a class="dropdown-item" href="{{ url('/info/campus/activity') }}">Kegiatan Kampus</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        Seputar Karir
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/job-vacancy') }}">Lowongan Kerja</a>
                            <a class="dropdown-item" href="{{ url('/schoolarship') }}">Beasiswa</a>
                            <a class="dropdown-item" href="{{ url('/job-articles?type=job_tips') }}">Tips Melamar Kerja</a>
                            <a class="dropdown-item" href="{{ url('/job-articles?type=career_development') }}">Tips Pengembangan Karir</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        Alumni
                        <div class="dropdown-menu">
                            <a class="dropdown-item nowrap" href="{{ url('/alumni') }}">Daftar Alumni</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div id="profile_menu" class="side-section pop-over">
            <div class="nav-menu h-90">
                <a class="decoration-none" href="{{ url('/home') }}">
                    <div class="menu-item flex-center">
                        <img class="user-profile mright-10" src="{{ \App\Helpers\Utils::user()->image == null ? '/guestAssets/img/pic.png' : asset(\App\Helpers\Utils::user()->image) }}" alt="">
                        <p>{{ \App\Helpers\Utils::user()->name }}</p>
                    </div>
                </a>
                <div class="menu-item grey-border"></div>
                <a class="menu-item" href="{{ url('/info/campus/lesson') }}">Alumni Mengajar</a>
                <a class="menu-item" href="{{ url('/info/campus/advanced') }}">Studi Lanjut</a>
                <a class="menu-item" href="{{ url('/info/campus/activity') }}">Kegiatan Kampus</a>
                <div class="menu-item grey-border"></div>
                <a class="menu-item" href="{{ url('/job-vacancy') }}">Lowongan Kerja</a>
                <a class="menu-item" href="{{ url('/schoolarship') }}">Beasiswa</a>
                <a class="menu-item" href="{{ url('/job-articles?type=job_tips') }}">Tips Melamar Kerja</a>
                <a class="menu-item" href="{{ url('/job-articles?type=career_development') }}">Tips Pengembangan Karir</a>
                <div class="menu-item grey-border"></div>
                <a class="menu-item" href="{{ url('/alumni') }}">Daftar Alumni</a>
                <a class="logout mtop-auto flex-center-between" href="{{route('logout')}}">
                    <span class="mright-10">Logout</span>
                    <img width="22" src="{{ asset('/guestAssets/img/logout-mobile.svg') }}" alt="">
                </a>
            </div>
        </div>
        @if (Auth::user()->role == 'student')
            <div id="report_menu" class="side-section pop-over">
                <div class="nav-menu h-auto">
                    <a class="menu-item" href="{{ url('/weekly-report?week=1') }}">Weekly Report</a>
                    <a class="menu-item" href="{{ url('/monthly-report?month=') }}">Monthly Report</a>
                    <a class="menu-item" href="{{ url('/final-report') }}">Final Report</a>
                </div>
            </div>
        @endif
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/header.js')}}" type="application/javascript" ></script>
        
    @endsection
</nav>