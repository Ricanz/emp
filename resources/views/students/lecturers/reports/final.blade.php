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
            <div class="col-lg-9 col-sm-12">
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
                @if ($final != null)
                    <div class="row flex-center-between mbottom-20">
                        <div class="main-menu-log w-100 shadow-mobile">
                            <div class="flex-center-between rounded-sm-top top-table-log">
                                <h4 class="fp-black fs-20">Laporan Akhir</h4>
                                    <a href="{{ url('/'.($final->attachment === null ? '' : $final->attachment->file)) }}" style="text-decoration: none" class="btn-rounded mleft-auto primary mbottom-20" target="_blank">Download Report</a>
                            </div>
                            <form id="add_final_notes_form" class="form-modal form-scroll mtop-20" enctype="multipart/form-data">
                                @csrf
                                <input class="input-grey" type="hidden" name="report_id" value="{{ $final->id }}">
                                <input class="input-grey" type="hidden" name="approval_id" value="{{ $final->approval == null ? '' : $final->approval->id }}">
                                <input class="input-grey" type="hidden" name="mitra_approval_id" value="{{ $final->mitra_approval == null ? '' : $final->mitra_approval->id }}">
                                <input class="input-grey" type="hidden" name="type" id="type" value="final">
                                <input class="input-grey" type="hidden" name="student_id" id="student_id" value="{{ $final->student_id }}">
                                
                                <div class="d-flex mbottom-20 flex-wrap">
                                    <div class="col-lg-2 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                                        <h5 class="fw-400">Deskripsi</h5>
                                    </div>
                                    <div class="col-lg-10 no-gutter col-sm-12">
                                        <textarea class="input-grey textarea" name="report" id="rep" rows="12" disabled>{{ $final->reports }}</textarea>
                                    </div>
                                </div>
                                @if(\App\Helpers\Utils::isLecturer(Auth::user()->id))
                                    <div class="d-flex mbottom-20 flex-wrap">
                                        <div class="col-lg-2 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                                            <h5 class="fw-400">Catatan Mitra</h5>
                                        </div>
                                        <div class="col-lg-10 no-gutter mtop-10 col-sm-12">
                                            <span>{{ $final->mitra_approval == null ? '' : $final->mitra_approval->notes }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex mbottom-20 flex-wrap">
                                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10 mbottom-10-mobile">
                                            <h5 class="fw-400">Catatan Dosen</h5>
                                        </div>
                                        <div class="col-lg-10 col-sm-12 no-gutter">
                                            <textarea class="input-grey textarea" name="notes" id="weekly_notes" rows="12">{{ $final->approval == null ? '' : $final->approval->notes }}</textarea>
                                        </div>
                                    </div>
                                @elseif(\App\Helpers\Utils::isMentor(Auth::user()->id))
                                    <div class="d-flex mbottom-20 flex-wrap">
                                        <div class="col-lg-2 no-gutter mtop-10 col-sm-12">
                                            <h5 class="fw-400">Catatan Mitra</h5>
                                        </div>
                                        <div class="col-lg-10 no-gutter mtop-10 col-sm-12">
                                            <span>{{ $final->mitra_approval == null ? '' : $final->approval->notes }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex mbottom-20">
                                        <div class="col-lg-2 no-gutter mtop-10">
                                            <h5 class="fw-400">Catatan Mitra</h5>
                                        </div>
                                        <div class="col-lg-10 no-gutter col-sm-12">
                                            <textarea class="input-grey textarea" name="mitra_notes" id="weekly_mitra_notes" rows="12">{{ $final->mitra_approval == null ? '' : $final->mitra_approval->notes }}</textarea>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex mbottom-20 flex-wrap">
                                    <div class="col-lg-2 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                                        <h5 class="fw-400">Rubrik Penilaian</h5>
                                    </div>
                                    <div class="col-lg-10 no-gutter col-sm-12">
                                        <input class="input-grey" type="file" name="rubrik" id="rubrik">
                                        @if ($rubrik != null)
                                            <a href="{{ url('/'.$rubrik->file) }}" target="_blank">Download Rubrik Penilaian</a>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn-rounded-lg mleft-auto primary">Submit</button>
                            </form>
                        </div>
                    </div>
                @else
                <div class="row flex-center-between mbottom-20">
                    <div class="main-menu-log w-100 shadow-mobile">
                        <div class="flex-center-between rounded-sm-top top-table-log">
                            <h4 class="fp-black fs-20">Belum ada Laporan Akhir</h4>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/lecturer.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>
