<nav class="navbar">
    @if (Auth::user()->role == 'student')
        <ul class="flex-center-between">
            <a class="decoration-none fp-white" href="{{ url('/') }}">
                <li>
                    <img src="/guestAssets/img/learning-menu.svg" alt="">
                    <span>Beranda</span>
                </li>
            </a>
            <a class="decoration-none fp-white" href="{{ url('/log-book') }}">
                <li>
                    <img src="/guestAssets/img/logbook-menu.svg" alt="">
                    <span>Log Book</span>
                </li>
            </a>
            <a class="decoration-none fp-white" href="{{ url('/assignment') }}">
                <li>
                    <img src="/guestAssets/img/assignment-menu.svg" alt="">
                    <span>Tugas</span>
                </li>
            </a>
            <a class="decoration-none fp-white" href="{{ url('/qna') }}">
                <li>
                    <img src="/guestAssets/img/qna-menu.svg" alt="">
                    <span>Tanya Jawab</span>
                </li>
            </a>
        </ul>
    @elseif (Auth::user()->role == 'lecturer')
        <ul class="flex-center-between">
            <a class="decoration-none fp-white" href="{{ url('/lecturer/home') }}">
                <li>
                    <img src="/guestAssets/img/learning-menu.svg" alt="">
                    <span>Beranda</span>
                </li>
            </a>
            <a class="decoration-none fp-white" href="{{ url('/lecturer/students') }}">
                <li>
                    <img src="/guestAssets/img/logbook-menu.svg" alt="">
                    <span>Mahasiswa</span>
                </li>
            </a>
            <a class="decoration-none fp-white" href="{{ \App\Helpers\Utils::isMentor(Auth::user()->id) ? url('/lecturer/assignments') : url('/lecturer/students') }}">
                <li>
                    <img src="/guestAssets/img/assignment-menu.svg" alt="">
                    <span>Tugas</span>
                </li>
            </a>
            <a class="decoration-none fp-white" href="{{ url('/qna') }}">
                <li>
                    <img src="/guestAssets/img/qna-menu.svg" alt="">
                    <span>Tanya Jawab</span>
                </li>
            </a>
        </ul>
    @elseif (Auth::user()->role == 'alumni')
    <ul class="flex-center-between">
        <a class="decoration-none fp-white" href="{{ url('/alumni/home') }}">
            <li>
                <img src="/guestAssets/img/learning-menu.svg" alt="">
                <span>Beranda</span>
            </li>
        </a>
        <a class="decoration-none fp-white" href="{{ url('/job-vacancy') }}">
            <li>
                <img src="/guestAssets/img/logbook-menu.svg" alt="">
                <span>Pekerjaan</span>
            </li>
        </a>
        <a class="decoration-none fp-white" href="{{ url('/schoolarship') }}">
            <li>
                <img src="/guestAssets/img/assignment-menu.svg" alt="">
                <span>Beasiswa</span>
            </li>
        </a>
        <a class="decoration-none fp-white" href="{{ url('/logout') }}">
            <li>
                <img src="/guestAssets/img/qna-menu.svg" alt="">
                <span>Logout</span>
            </li>
        </a>
    </ul>
    @endif
</nav>