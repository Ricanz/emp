<div id="submit_assignment" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal pt-30 pb-30 pr-20 pl-20">
            <div class="modal-default">
                <div class="d-flex justify-between mtop-10 mbottom-20">
                    <h3 class="fs-18">Submit Tugas</h3>
                    {{-- <h5 class="fw-400">Senin, 28 Jan 2023</h5> --}}
                </div>
                <form id="create_assignment_form" class="form-scroll">
                    @csrf
                    <div class="flex-center mbottom-15 flex-wrap">
                        <div class="col-lg-3 no-gutter col-sm-12 mbottom-10-mobile">
                            <h5 class="fw-400">Judul Tugas</h5>
                        </div>
                        <div class="col-lg-9 no-gutter col-sm-12">
                            <h5 class="fw-400" id="s_assignment_title">Membuat API</h5>
                        </div>
                    </div>
                    <div class="d-flex mbottom-15 flex-wrap">
                        <div class="col-lg-3 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                            <h5 class="fw-400">Deskripsi</h5>
                        </div>
                        <div class="col-lg-9 no-gutter col-sm-12" id="s_assignment_description"></div>
                    </div>
                    <input class="input-grey" type="hidden" name="assignment_id" id="send_assignment_id">
                    <input class="input-grey" type="hidden" name="id" id="assignment_id">
                    <div class="d-flex mbottom-15 flex-wrap">
                        <div class="col-lg-3 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                            <h5 class="fw-400">Catatan</h5>
                        </div>
                        <div class="col-lg-9 no-gutter col-sm-12">
                            <input type="text" class="input-grey" name="s_title" id="assignment_title">
                        </div>
                    </div>
                    <div class="upload-file doc mbottom-30">
                        <div class="upload-file mbottom-20">
                            <h5 class="fw-700 fp-blue text-right pointer">Upload Tugas</h5>
                            <input class="input-file" id="assignment_upload_file" name="upload_file[]" type="file" onchange="assignment_preview_image()" accept=".jpg, .jpeg, .docx, .pdf" multiple />
                            <div id="assignment_image_preview" class="container-img-preview flex-center"></div>
                        </div>
                    </div>
                    <div class="d-flex mbottom-20">
                        <div class="col-lg-3 no-gutter">
                            <a href="" target="_blank" id="download_student_assignment" style="text-decoration: none" class="btn-rounded-lg mleft-auto primary mbottom-20">Download</a>
                        </div>
                        <div class="col-lg-9 no-gutter">
                            <button type="submit" class="btn-rounded-lg mleft-auto primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>