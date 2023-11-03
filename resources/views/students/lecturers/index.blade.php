<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="card border-primary-grey rounded-sm profile">
                    <img class="profile125" src="{{ asset($lecturer->image) }}" alt="">
                    <div class="flex-center-between mtop-20">
                        <h5>Nama</h5>
                        <h5 class="fw-400">{{ $lecturer->name }}</h5>
                    </div>
                    <div class="border2-secondary-grey mtop-10 mbottom-10 m-auto w-100 rounded-sm"></div>
                    <div class="flex-center-between mtop-20">
                        <h5>Jenis</h5>
                        <h5 class="fw-400">{{ ($lecturer->jenis) }}</h5>
                    </div>
                    <div class="border2-secondary-grey mtop-10 mbottom-10 m-auto w-100 rounded-sm"></div>
                    <div class="text-center mtop-10">
                        <h5 class="fw-400">{{ $lecturer->email }}</h5>
                    </div>
                    <div class="border-bottom-profile"></div>
                </div>
                <a class="btn-square-md-mobile white border-primary-darkgrey w-100 mtop-20 mbottom-20 p-12 decoration-none mobile-display text-center" href="{{route('logout')}}">
                    <span class="mright-10">Logout</span>
                    <img width="15" src="{{ asset('/guestAssets/img/logout.svg') }}" alt="">
                </a>
            </div>
            <div class="col-lg-9 col-sm-12 mobile-none">
                <div class="row flex-center-between mbottom-20">
                    @if (\App\Helpers\Utils::isMentor(Auth::user()->id) || \App\Helpers\Utils::isLecturer(Auth::user()->id))
                        <div class="col-lg-3 pointer">
                            <a href="{{ url('/lecturer/rubrik') }}" class="decoration-none">
                                <div class="card border-primary-grey rounded-sm program">
                                    <img width="90" src="{{ asset('/guestAssets/img/ic-learning.svg') }}" alt="">
                                    <span>Rubrik Penilaian</span>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="col-lg-3">
                            <div class="card border-primary-grey rounded-sm program">
                                <img width="90" src="{{ asset('/guestAssets/img/ic-learning.svg') }}" alt="">
                                <span>Learning Plan</span>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-3 pointer" id="_to_students_report_">
                        <div class="card border-primary-grey rounded-sm program">
                            <img width="80" src="{{ asset('/guestAssets/img/ic-logbook.svg') }}" alt="">
                            <span>Mahasiswa</span>
                        </div>
                    </div>
                    <div class="col-lg-3 pointer">
                        <a href="{{ \App\Helpers\Utils::isMentor(Auth::user()->id) ? url('/lecturer/assignments') : url('/lecturer/students') }}" class="decoration-none">
                            <div class="card border-primary-grey rounded-sm program">
                                <img width="70" src="{{ asset('/guestAssets/img/ic-assignment.svg')}}" alt="">
                                <span>Tugas</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ url('/qna') }}" class="decoration-none">
                            <div class="card border-primary-grey rounded-sm program">
                                <img width="80" src="{{ asset('/guestAssets/img/ic-qna.svg') }}" alt="">
                                <span>Tanya Jawab</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>