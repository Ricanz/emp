<div id="create_assignment_modal" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal pt-30 pb-30 pr-20 pl-20">
            <div class="modal-default">
                <div class="d-flex justify-between mtop-10 mbottom-20">
                    <h3 class="fs-18">Tambah Tugas</h3>
                </div>
                <form id="lecturer_create_assignment_form" class="form-scroll">
                    @csrf
                    <div class="d-flex mbottom-15 flex-wrap">
                        <div class="col-lg-3 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                            <h5 class="fw-400">Judul</h5>
                        </div>
                        <div class="col-lg-9 no-gutter col-sm-12">
                            <input type="text" class="input-grey" name="title">
                        </div>
                    </div>
                    <div class="d-flex mbottom-15 flex-wrap">
                        <div class="col-lg-3 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                            <h5 class="fw-400">Deskripsi</h5>
                        </div>
                        <div class="col-lg-9 no-gutter col-sm-12">
                            <textarea class="textarea input-grey" name="description"></textarea>
                        </div>
                    </div>
                    <div class="d-flex mbottom-15 flex-wrap">
                        <div class="col-lg-3 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                            <h5 class="fw-400">Tipe</h5>
                        </div>
                        <div class="col-lg-9 no-gutter col-sm-12">
                            <select name="type" id="" class="input-grey">
                                <option value="Mingguan">Mingguan</option>
                                <option value="Bulanan">Bulanan</option>
                                <option value="Tahunan">Tahunan</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex mbottom-15 flex-wrap">
                        <div class="col-lg-3 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                            <h5 class="fw-400">Tanggal Mulai</h5>
                        </div>
                        <div class="col-lg-9 no-gutter col-sm-12">
                            <input type="datetime-local" class="input-grey" name="start_date" id="assignment_title">
                        </div>
                    </div>
                    <div class="d-flex mbottom-15 flex-wrap">
                        <div class="col-lg-3 no-gutter mtop-10 col-sm-12 mbottom-10-mobile">
                            <h5 class="fw-400">Berakhir</h5>
                        </div>
                        <div class="col-lg-9 no-gutter col-sm-12">
                            <input type="datetime-local" class="input-grey" name="end_date" id="assignment_title">
                        </div>
                    </div>
                    <div class="upload-file doc mbottom-30">
                        <label class="custom-doc-upload" id="label_lecturer_assignment"></label>
                        <input class="d-none" id="lecturer_assignment_image" name='upload_cont_img' type="file">
                        <label class="fp-blue fw-700 pointer" for="lecturer_assignment_image">Upload File</label>
                    </div>
                    <div class="d-flex mbottom-15">
                        <div class="col-lg-12 no-gutter">
                            <button type="submit" class="btn-rounded-lg mleft-auto primary">Posting</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>