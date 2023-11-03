<div id="modal_alumni" class="modal">
    <div class="modal-body md">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-default profile-alumni">
                <h3 class="fs-18 mbottom-15">Profile Alumni</h3>
                <form id="work_experience_form" class="form-scroll mtop-20">
                    @csrf
                    <div class="row">
                        <div class="col-lg-2 col-sm-5">
                            <div class="container-image">
                                <img id="alumni_image" src="{{ asset('/guestAssets/img/pic.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-10 col-sm-7">
                            <div class="container-profile">
                                    <h5 class="mbottom-5">Nama : </h5>
                                    <h5 class="mbottom-10 fw-600" id="alumni_name"></h5>
                                    <h5 class="mbottom-5">NIM : </h5>
                                    <h5 class="mbottom-10 fw-600" id="alumni_nim"></h5>
                                    <h5 class="mbottom-5">Riwayat Pekerjaan : </h5>
                                    <div class="alumni-experience">
                                        <h5 class="fw-400 fp-black" id="alumni_riwayat"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>