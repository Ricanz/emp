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
                <div class="mtop-15 pointer">
                    <a href="{{ url('/lecturer/students/final/'.$student->nim) }}" class="decoration-none">
                        <div class="card-black">
                            <img src="{{ asset('/guestAssets/img/report.svg') }}" alt="">
                            <span>Final Report</span>
                        </div>
                    </a>
                </div>
                <div class="mtop-15 pointer">
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
                    <div class="col-lg-4 pointer col-sm-12 mtop-15-mobile">
                        <a href="{{ url('/lecturer/students/details/'.$student->nim) }}" class="decoration-none">
                            <div class="card-black">
                                <img src="{{ asset('/guestAssets/img/report.svg') }}" alt="">
                                <span>Logbook</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 pointer col-sm-12 mtop-15-mobile">
                        <a href="{{ url('/lecturer/students/weekly/'.$student->nim) }}" class="decoration-none">
                            <div class="card-black">
                                <img src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                <span>Weekly Report</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 pointer col-sm-12 mtop-15-mobile">
                        <a href="{{ url('/lecturer/students/monthly/'.$student->nim) }}" class="decoration-none">
                            <div class="card-black">
                                <img src="{{ asset('/guestAssets/img/calendar.svg') }}" alt="">
                                <span>Monthly Report</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row flex-center-between mbottom-20">
                    <div class="main-menu-log shadow-mobile w-100">
                        <div class="flex-center-between rounded-sm-top top-table-log">
                            <h4 class="fp-black fs-20">Assignment</h4>
                        </div>
                        <div class="overflow-mobile">
                            <div class="table-responsive">
                                <div class="flex-center title-table-log assignment-lecturer">
                                    <div>Judul Tugas</div>
                                    <div>Due Date</div>
                                    <div>Status</div>
                                    <div>Catatan</div>
                                    <div>Action</div>
                                </div>
                                @foreach ($data as $item)
                                    <div class="flex-center rounded-sm-bottom content-table-log assignment-lecturer">
                                        <div>{{ Str::limit($item->title, 15, '...') }}</div>
                                        <div>{{ $item->end_date->format('d/m/Y H:i:s') }}</div>
                                        <div>{{ $item->student_task == null ? 'Belum ada laporan' : ($item->student_task->approved_by_lecturer ? 'Disetujui' : 'Menunggu Konfirmasi') }}</div>
                                        <div>Note dosen</div>
                                        <div>
                                            <button class="btn-rounded-sm primary btn-view" 
                                                    id="lecturer_submit_assignment"
                                                    data-id="{{ $item->student_task == null ? '' : $item->student_task->id }}"
                                                    data-title="{{ $item->title }}"
                                                    data-description="{{ $item->description }}"
                                                    data-file="{{ $item->image }}"
                                                    data-student_title="{{ $item->student_task == null ? '' : $item->student_task->title }}"
                                                    data-approval_id="{{ $item->approval == null ? '' : $item->approval->id }}"
                                                    data-notes="{{ $item->approval == null ? '' : $item->approval->notes }}"
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
