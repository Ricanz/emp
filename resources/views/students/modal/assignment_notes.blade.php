<div id="submit_assignment_notes" class="modal">
    <div class="modal-body md no-gutter">
        <div class="close md close-modal"></div>
        <div class="content-modal pt-30 pb-30 pr-20 pl-20">
            <div class="modal-default">
                <div class="d-flex justify-between mtop-10 mbottom-20">
                    <h3 class="fs-18">Cek Tugas Mahasiswa</h3>
                    {{-- <h5 class="fw-400">Senin, 28 Jan 2023</h5> --}}
                </div>
                <form id="create_task_approval" class="form-scroll">
                    @csrf
                    <div class="flex-center mbottom-20">
                        <div class="col-lg-3 no-gutter">
                            <h5 class="fw-400">Judul Tugas</h5>
                        </div>
                        <div class="col-lg-9 no-gutter">
                            <h5 class="fw-400" id="assignment_title">Membuat API</h5>
                        </div>
                    </div>
                    <div class="d-flex mbottom-20">
                        <div class="col-lg-3 no-gutter mtop-10">
                            <h5 class="fw-400">Deskripsi</h5>
                            {{-- <a href="" class="btn-rounded-lg mleft-auto primary mbottom-20">Download</a> --}}
                        </div>
                        <div class="col-lg-9 no-gutter" id="assignment_description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione porro non laudantium tempore quibusdam incidunt reiciendis in impedit asperiores ex ullam quis minima iusto consectetur a repellat praesentium eveniet esse itaque amet totam, autem blanditiis deleniti labore! Magnam exercitationem fugiat cum! Sed maxime numquam repellat inventore, reprehenderit, nisi esse perspiciatis atque temporibus quaerat hic corrupti aspernatur sequi sint, eius qui corporis unde blanditiis dignissimos dicta. Nesciunt possimus excepturi amet unde ratione dolorum illum nemo ipsam deserunt animi. Optio earum placeat blanditiis iste, modi quod ratione excepturi vel amet odio voluptatibus neque! Eos possimus nisi illum officia optio? Quibusdam, laboriosam eius!
                        </div>
                    </div>
                    {{-- <div class="flex-center mbottom-20">
                        <div class="col-lg-3 no-gutter">
                            <h5 class="fw-400">Tipe Tugas</h5>
                        </div>
                        <div class="col-lg-9 no-gutter">
                            <div class="select-custom" data-id="select_type">
                                <div class="option-item selected">
                                    <img width="15" class="mright-10" src="{{ asset('/guestAssets/img/dropdown-select.svg') }}" alt="">
                                    <label>Bulanan</label>
                                </div>
                                <div id="preview_select_type" class="option-container">
                                    <div class="option-item">
                                        <input type="radio" class="radio" id="option1">
                                        <label for="">Harian</label>
                                    </div>
                                    <div class="option-item">
                                        <input type="radio" class="radio" id="option1">
                                        <label for="">Mingguan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-center mbottom-20">
                        <div class="col-lg-3 no-gutter">
                            <h5 class="fw-400">Bulan</h5>
                        </div>
                        <div class="col-lg-9 no-gutter">
                            <div id="select_month" class="select-custom" data-id="select_month">
                                <div class="option-item selected">
                                    <img width="30" src="{{ asset('/guestAssets/img/ic-calendar.svg') }}" alt="">
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
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-flex mbottom-20">
                        <div class="col-lg-3 no-gutter mtop-10">
                            <h5 class="fw-400">Assignment Mahasiswa</h5>
                        </div>
                        <div class="col-lg-9 no-gutter">
                            <input type="text" class="input-grey" name="assignment_title" id="assignment_student_title">
                            <div class="image-container mtop-10">
                                <div id="lecturer_assignment_preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mbottom-20">
                        <div class="col-lg-3 no-gutter mtop-10">
                            <h5 class="fw-400">Catatan</h5>
                        </div>
                        <div class="col-lg-9 no-gutter">
                            <textarea class="input-grey textarea" name="notes" id="assignment_notes" rows="12"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="approval_id" id="le_assignment_approval_id">
                    <input type="hidden" name="assignment_id" id="le_assignment_id">
                    <div class="d-flex mbottom-20">
                        <div class="col-lg-3 no-gutter">
                            <a href="" target="_blank" id="download_assignment" style="text-decoration: none" class="btn-rounded-lg mleft-auto primary mbottom-20">Download</a>
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