<x-guest-layout>
    <div class="container">
        <div class="row mbottom-30">
            <div class="col-lg-12 flex-center">
                <img class="mright-10" width="45" src="{{ asset('/guestAssets/img/ic-assignment.svg') }}" alt="">
                <h3 class="fw-700 title">Tugas</h3>
            </div>
        </div>
        <div class="row mbottom-60">
            <div class="col-lg-12 no-gutter main-menu-log">
                <div class="flex-center-between rounded-sm-top top-table-log">
                    <h4 class="fp-black fs-20">Tugas</h4>
                    {{-- <div id="select_month" class="select-custom" data-id="select_month">
                        <div class="option-item selected">
                            <img width="14" class="mright-10" src="{{ asset('/guestAssets/img/dropdown-select.svg') }}" alt="">
                            <label>Januari</label>
                        </div>
                        <div id="preview_select_month" class="option-container">
                            <div class="option-item">
                                <input type="radio" class="radio" id="option1">
                                <label for="">Februari</label>
                            </div>
                            <div class="option-item">
                                <input type="radio" class="radio" id="option1">
                                <label for="">Maret</label>
                            </div>
                            <div class="option-item">
                                <input type="radio" class="radio" id="option1">
                                <label for="">April</label>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="overflow-mobile">
                    <div class="table-responsive">
                        <div class="flex-center title-table-log assignment">
                            <div>Judul Tugas</div>
                            <div>Bulan</div>
                            <div>Tipe Tugas</div>
                            <div>Due Date</div>
                            <div>Status</div>
                            <div>Action</div>
                        </div>
                        @if (count($assignments) > 0)
                            @foreach ($assignments as $item)
                                <div class="flex-center rounded-sm-bottom content-table-log assignment">
                                    <div><h5 class="fw-400 text-ellipsis">{{ $item->title }}</h5></div>
                                    <div>{{ $item->end_date->format('F') }}</div>
                                    <div>{{ $item->type }}</div>
                                    <div>{{ $item->end_date->format('d M Y') }} | {{ $item->end_date->format('H:i') }} WIB</div>
                                    <div>{{ $item->student_task == null ? 'Belum Submit' : ($item->student_task->approved_by_lecturer ? 'Disetujui' : 'Menunggu persetujuan') }}</div>
                                    <div>
                                        <button id="submit_assignments" class="btn-rounded-sm primary view-assignment {{ $item->end_date <= now() ? 'expired' : '' }}"
                                        data-id="{{ $item->id }}"
                                        data-assignment_id="{{ $item->student_task == null ? '' : $item->student_task->id }}"
                                        data-assignment_title="{{ $item->student_task == null ? '' : $item->student_task->title }}"
                                        data-title="{{ $item->title }}"
                                        data-description="{{ $item->description }}"
                                        data-file="{{ $item->image }}"
                                        data-attachment="{{ $item->attachment == null ? '' : $item->attachment }}" {{ $item->end_date <= now() ? 'disabled' : '' }}></button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex-center rounded-sm-bottom content-table-log empty w-100">
                                <h5 class="fp-black m-auto fs-13 fw-400">Belum Ada Aktivitas</h5>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/assignment.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>