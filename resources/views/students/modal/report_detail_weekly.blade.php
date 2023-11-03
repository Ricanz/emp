<div id="weekly_report_detail" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-default">
                <div class="top-modal d-flex justify-between mtop-10 mbottom-20 flex-wrap">
                    <h3 class="fs-18" id="detail_report_title">Weekly Detail Report</h3>
                    <div class="text-right">
                        <h5 class="fw-400" id="weekly_week"></h5>
                    </div>
                </div>
                <form id="add_weekly_notes_form" class="form-modal form-scroll">
                    @csrf
                    <input class="input-grey" type="hidden" name="report_id" id="weekly_report_id">
                    <input class="input-grey" type="hidden" name="approval_id" id="weekly_approval_id">
                    <input class="input-grey" type="hidden" name="mitra_approval_id" id="weekly_mitra_approval_id">
                    <input class="input-grey" type="hidden" name="type" id="type">
                    <div class="d-flex mbottom-20 flex-wrap">
                        <div class="col-lg-2 no-gutter mtop-10 col-sm-12">
                            <h5 class="fw-400 mbottom-10-mobile">Deskripsi</h5>
                        </div>
                        <div class="col-lg-10 no-gutter col-sm-12">
                            <textarea class="input-grey textarea" name="report" id="rep" rows="12" disabled></textarea>
                            <div class="upload-file">
                                <input id="input_file_weekly" class="input-file" name="file" type="file" multiple />
                                <div id="lecturer_preview" class="container-img-preview flex-center"></div>
                            </div>
                        </div>
                    </div>
                    
                    @if (\App\Helpers\Utils::isLecturer(Auth::user()->id))
                        <div class="d-flex mbottom-20 flex-wrap">
                            <div class="col-lg-2 no-gutter mtop-10 col-sm-12">
                                <h5 class="fw-400">Catatan Mitra</h5>
                            </div>
                            <div class="col-lg-10 no-gutter mtop-20">
                                <span id="le_weekly_mitra_notes"></span>
                            </div>
                        </div>
                        <div class="d-flex mbottom-20">
                            <div class="col-lg-2 no-gutter mtop-10 col-sm-12">
                                <h5 class="fw-400">Catatan Dosen</h5>
                            </div>
                            <div class="col-lg-10 no-gutter">
                                <textarea class="input-grey textarea" name="notes" id="weekly_notes" rows="12"></textarea>
                            </div>
                        </div>
                    @elseif(\App\Helpers\Utils::isMentor(Auth::user()->id))
                        <div class="d-flex mbottom-20">
                            <div class="col-lg-2 no-gutter mtop-10">
                                <h5 class="fw-400">Catatan Dosen</h5>
                            </div>
                            <div class="col-lg-10 no-gutter mtop-20">
                                <span id="weekly_notes"></span>
                            </div>
                        </div>
                        <div class="d-flex mbottom-20">
                            <div class="col-lg-2 no-gutter mtop-10">
                                <h5 class="fw-400">Catatan Mitra</h5>
                            </div>
                            <div class="col-lg-10 no-gutter">
                                <textarea class="input-grey textarea" name="mitra_notes" id="le_weekly_mitra_notes" rows="12"></textarea>
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