<div id="report_detail" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-default">
                <div class="top-modal d-flex justify-between mtop-10 mbottom-20">
                    <h3 class="fs-18">Detail Report</h3>
                    <div class="text-right">
                        <h5 class="fw-400" id="logbook_date"></h5>
                        <h5 class="fw-400">
                            <b>Clock In</b> 
                            <span id="logbook_clockin"></span>
                        </h5>
                    </div>
                </div>
                <form id="add_notes_form" class="form-modal form-scroll">
                    @csrf
                    <div class="flex-center mbottom-20">
                        <div class="col-lg-2 no-gutter">
                            <h5 class="fw-400">Aktivitas</h5>
                        </div>
                        <div class="col-lg-10 no-gutter">
                            <input class="input-grey" type="text" name="title" id="logbook_title" disabled>
                        </div>
                    </div>
                    <input class="input-grey" type="hidden" name="report_id" id="logbook_report_id">
                    <input class="input-grey" type="hidden" name="approval_id" id="logbook_approval_id">
                    <input class="input-grey" type="hidden" name="mitra_approval_id" id="logbook_mitra_approval_id">
                    <input class="input-grey" type="hidden" name="type" id="logbook_type" value="daily">
                    <div class="d-flex mbottom-20">
                        <div class="col-lg-2 no-gutter mtop-10">
                            <h5 class="fw-400">Deskripsi</h5>
                        </div>
                        <div class="col-lg-10 no-gutter">
                            <textarea class="input-grey textarea" name="report" id="logbook_reports" rows="12" disabled></textarea>
                            <div class="upload-file">
                                <input id="input_file_report" class="input-file" name="file" type="file" multiple />
                                <div class="image-container">
                                    <div id="weekly_lecturer_preview" class="container-img-preview flex-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (\App\Helpers\Utils::isLecturer(Auth::user()->id))
                        <div class="d-flex mbottom-20">
                            <div class="col-lg-2 no-gutter mtop-10">
                                <h5 class="fw-400">Catatan Mitra</h5>
                            </div>
                            <div class="col-lg-10 no-gutter mtop-20">
                                <span id="logbook_mitra_notes"></span>
                            </div>
                        </div>
                        <div class="d-flex mbottom-20">
                            <div class="col-lg-2 no-gutter mtop-10">
                                <h5 class="fw-400">Catatan Dosen</h5>
                            </div>
                            <div class="col-lg-10 no-gutter">
                                <textarea class="input-grey textarea" name="notes" id="logbook_notes" rows="12"></textarea>
                            </div>
                        </div>
                    @elseif (\App\Helpers\Utils::isMentor(Auth::user()->id))
                        <div class="d-flex mbottom-20">
                            <div class="col-lg-2 no-gutter mtop-10">
                                <h5 class="fw-400">Catatan Dosen</h5>
                            </div>
                            <div class="col-lg-10 no-gutter mtop-20">
                                <span id="logbook_dosen_notes"></span>
                            </div>
                        </div>
                        <div class="d-flex mbottom-20">
                            <div class="col-lg-2 no-gutter mtop-10">
                                <h5 class="fw-400">Catatan Mitra</h5>
                            </div>
                            <div class="col-lg-10 no-gutter">
                                <textarea class="input-grey textarea" name="mitra_notes" id="logbook_mitra_notes" rows="12"></textarea>
                            </div>
                        </div>
                    @endif
                    
                    <button type="submit" class="btn-rounded-lg mleft-auto primary" id="modal_button">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script src="{{url('/custom/guest/lecturer.js')}}" type="application/javascript" ></script>
@endsection