<div id="modal_activity" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-default">
                <div class="top-modal d-flex justify-between mtop-10 mbottom-20 flex-wrap">
                    <h3 class="fs-18">Tambah Aktivitas</h3>
                    <div class="text-right">
                        <h5 class="fw-400" id="daily_date">Senin, 28 Jan 2023</h5>
                        <h5 class="fw-400">
                            <b>Clock In</b> 
                            <span id="clock_in">
                                09:12:53 WIB
                            </span>
                        </h5>
                    </div>
                </div>
                <form id="create_activity_form" class="form-modal form-scroll">
                    @csrf
                    <div class="flex-center flex-wrap mbottom-20">
                        <div class="col-lg-2 col-sm-12 no-gutter">
                            <h5 class="fw-400">Aktivitas</h5>
                        </div>
                        <div class="col-lg-10 col-sm-12 no-gutter">
                            <input class="input-grey" type="text" name="title" id="title">
                        </div>
                    </div>
                    <input class="input-grey" type="hidden" name="report_id" id="report_id">
                    <div class="d-flex flex-wrap mbottom-20">
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10">
                            <h5 class="fw-400">Deskripsi</h5>
                        </div>
                        <div class="col-lg-10 col-sm-12 no-gutter">
                            <textarea class="input-grey textarea" name="report" id="report" rows="12"></textarea>
                            <div class="upload-file mbottom-20">
                                <h5 class="fw-700 fp-blue text-right pointer">Upload File</h5>
                                <input class="input-file" id="upload_file" name="upload_file[]" type="file" onchange="preview_image()" accept=".jpg, .jpeg, .docx, .pdf" multiple />
                                <div id="image_preview" class="container-img-preview flex-center"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 no-gutter mbottom-20">
                        <div id="map"></div>
                    </div>
                    <div class="d-flex flex-wrap mbottom-20">
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10 d-none" id="dosen_text">
                            <h5 class="fw-400">Catatan Dosen</h5>
                        </div>
                        <div class="col-lg-10 col-sm-12 no-gutter d-none" id="dosen_input">
                            <textarea class="input-grey textarea" name="lecturer_approval" id="lecturer_approval" rows="12" disabled></textarea>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap mbottom-20">
                        <div class="col-lg-2 col-sm-12 no-gutter mtop-10 d-none" id="mitra_text">
                            <h5 class="fw-400">Catatan Mitra</h5>
                        </div>
                        <div class="col-lg-10 col-sm-12 no-gutter d-none" id="mitra_input">
                            <textarea class="input-grey textarea" name="mitra_approval" id="mitra_approval" rows="12" disabled></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-rounded-lg mleft-auto primary" id="modal_button">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>