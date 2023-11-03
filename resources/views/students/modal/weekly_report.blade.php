<div id="modal_weekly_report" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-default report">
                <div class="top-modal d-flex justify-between mtop-10 mbottom-20 flex-wrap">
                    <h3 class="fs-18">Laporan Mingguan</h3>
                    <div class="text-right">
                        <b id="week_text"></b>
                        <h5 class="fw-400" id="range_text"></h5>
                    </div>
                </div>
                <form class="form-modal form-scroll" id="weekly_report_form">
                    @csrf
                    <div class="d-flex flex-wrap mbottom-20">
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10">
                            <h5 class="fw-400">Deskripsi</h5>
                        </div>
                        <input type="hidden" name="week_id" id="modal_week_id">
                        <div class="col-lg-10 col-sm-12 no-gutter">
                            <textarea class="input-grey textarea" name="report" id="weekly_reports" rows="12"></textarea>
                            <div class="upload-file mbottom-20">
                                <h5 class="fw-700 fp-blue text-right pointer">Upload File</h5>
                                <input class="input-file" id="preview_input_file_weekly" name="upload_file[]" type="file" onchange="weekly_preview_image()" accept=".jpg, .jpeg, .docx, .pdf" multiple />
                                <div id="weekly_image_preview" class="container-img-preview flex-center"></div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10 d-none" id="weekly_lecturer_text">
                            <h5 class="fw-400">Catatan Dosen</h5>
                        </div>
                        <div class="col-lg-10 col-sm-12 no-gutter d-none" id="weekly_lecturer_input">
                            <textarea class="input-grey textarea" name="weekly_lecturer_notes" id="weekly_lecturer_notes" rows="12"></textarea>
                        </div>
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10 d-none" id="weekly_mitra_text">
                            <h5 class="fw-400">Catatan Mitra</h5>
                        </div>
                        <div class="col-lg-10 col-sm-12 no-gutter d-none" id="weekly_mitra_input">
                            <textarea class="input-grey textarea" name="weekly_mitra_notes" id="weekly_mitra_notes" rows="12"></textarea>
                        </div>
                        <button type="submit" class="btn-rounded-lg mleft-auto primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>