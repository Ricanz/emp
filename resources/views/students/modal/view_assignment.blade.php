<div id="view_assignment" class="modal">
    <div class="modal-body md">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-default">
                <div class="d-flex justify-between mtop-10 mbottom-20">
                    <h3 class="fs-18">Tambah Aktivitas</h3>
                    <div class="text-right">
                        <h5 class="fw-400">Senin, 28 Jan 2023</h5>
                        <h5 class="fw-400"><b>Clock In</b> 09:12:53 WIB</h5>
                    </div>
                </div>
                <form id="create_activity_form">
                    @csrf
                    <div class="flex-center mbottom-20">
                        <div class="col-lg-2 no-gutter">
                            <h5 class="fw-400">Aktivitas</h5>
                        </div>
                        <div class="col-lg-10 no-gutter">
                            <input class="input-grey" type="text" name="title">
                        </div>
                    </div>
                    <div class="d-flex mbottom-20">
                        <div class="col-lg-2 no-gutter mtop-10">
                            <h5 class="fw-400">Deskripsi</h5>
                        </div>
                        <div class="col-lg-10 no-gutter">
                            <textarea class="input-grey textarea" name="report" id="" rows="12"></textarea>
                            <div class="upload-file">
                                <h5 class="fw-700 fp-blue text-right pointer">Upload File</h5>
                                <input id="input_file_assignment" class="input-file" name="file" type="file" multiple />
                                <div class="image-container">
                                    <img class="image-uploaded" id="preview_input_file_assignment" src="{{ asset('guestAssets/img/dummy-image.svg') }}" alt="your image" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-rounded-lg mleft-auto primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>