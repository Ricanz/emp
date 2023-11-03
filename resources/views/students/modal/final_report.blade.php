<div id="modal_final_report" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-default report">
                <h3 class="top-modal fs-18 mtop-10 mbottom-20">Laporan Akhir</h3>
                <form id="final_report_form" class="form-modal form-scroll">
                    @csrf
                    <div class="d-flex mbottom-20">
                        <div class="col-lg-2 no-gutter mtop-10">
                            <h5 class="fw-400">Deskripsi</h5>
                        </div>
                        <input type="hidden" name="report_id" id="reports_id">
                        {{-- <input type="text" name="report_id" id="input_test"> --}}
                        <div class="col-lg-10 no-gutter">
                            <textarea class="input-grey textarea" name="report" id="report_final" rows="12"></textarea>
                        </div>
                    </div>
                    {{-- <div class="d-flex mbottom-20">
                        <div class="col-lg-2 no-gutter">
                            <h5 class="fw-400">Bulan</h5>
                        </div>
                        <div class="col-lg-10 no-gutter">
                            <div class="select-custom mright-10" data-id="select_date">
                                <div class="option-item selected">
                                    <img width="28" class="mright-10" src="{{ asset('/guestAssets/img/ic-calendar.svg') }}" alt="">
                                    <label>01/01/2023</label>
                                </div>
                                <div id="preview_select_date" class="option-container">
                                    <div class="option-item">
                                        <input type="radio" class="radio" id="option1">
                                        <label>02/01/2023</label>
                                    </div>e
                                    <div class="option-item">
                                        <input type="radio" class="radio" id="option1">
                                        <label>03/01/2023</label>
                                    </div>
                                    <div class="option-item">
                                        <input type="radio" class="radio" id="option1">
                                        <label>04/01/2023</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="upload-file doc mbottom-30">
                        <label class="custom-doc-upload"></label>
                        <input class="d-none" id="file-upload" name='upload_cont_img' type="file" multiple>
                        <label class="fp-blue fw-700 pointer" for="file-upload">Lampirkan Tugas</label>
                    </div>
                    <div class="flex-center justify-right">
                        <a id="attachment_download" target="_blank"></a>
                        <button type="submit" class="btn-rounded-lg primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script src="{{url('/custom/guest/final.js')}}" type="application/javascript" ></script>
@endsection