<div id="modal_monthly_report" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-default report">
                <div class="top-modal d-flex justify-between mtop-10 mbottom-20 flex-wrap">
                    <h3 class="fs-18">Laporan Bulanan</h3>
                    <div class="text-right">
                        <b id="month_text">Januari</b>
                    </div>
                </div>
                <form id="monthly_report_form" class="form-modal form-scroll">
                    @csrf
                    <div class="d-flex flex-wrap mbottom-20">
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10">
                            <h5 class="fw-400">Deskripsi</h5>
                        </div>
                        <input type="hidden" name="month_id" id="month_id">
                        <div class="col-lg-10 col-sm-12 no-gutter">
                            <textarea class="input-grey textarea" name="report" id="monthly_reports" rows="12"></textarea>
                            <div class="upload-file mbottom-20">
                                <h5 class="fw-700 fp-blue text-right pointer">Upload File</h5>
                                <input class="input-file" id="input_file_monthly" name="upload_file[]" type="file" onchange="monthly_preview_image()" accept=".jpg, .jpeg, .docx, .pdf" multiple />
                                <div id="monthly_image_preview" class="container-img-preview flex-center"></div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10 d-none" id="monthly_lecturer_text">
                            <h5 class="fw-400">Catatan Dosen</h5>
                        </div>
                        <div class="col-lg-10 col-sm-12 no-gutter d-none" id="monthly_lecturer_input">
                            <textarea class="input-grey textarea" name="monthly_lecturer_approval" id="monthly_lecturer_approval" rows="12"></textarea>
                        </div>
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10 d-none" id="monthly_mitra_text">
                            <h5 class="fw-400">Catatan Mitra</h5>
                        </div>
                        <div class="col-lg-10 col-sm-12 no-gutter d-none" id="monthly_mitra_input">
                            <textarea class="input-grey textarea" name="monthly_mitra_approval" id="monthly_mitra_approval" rows="12"></textarea>
                        </div>
                        <button type="submit" class="btn-rounded-lg mleft-auto primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>