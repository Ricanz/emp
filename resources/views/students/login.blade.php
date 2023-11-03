<!DOCTYPE html>
<html lang="en">
@include('students/layouts/head')

<body>
    <div class="container-fluid login">
        <img class="logo-up" src="{{ asset('/guestAssets/img/logo-up-transparent.png') }}" alt="">
        <div class="flex-center-between">
            <div class="logo-text col-lg-6 text-center mobile-none">
                <b class="fp-white fs-38 fw-800">M-Knows Consulting</b> <br>
                <b class="fp-white fs-38 fw-800">{{ \App\Helpers\Utils::login_title()->title }}</b> 
                <h2 class="fp-white fs-24 fw-400 w-50 m-auto">{{ \App\Helpers\Utils::login_title()->description }}</h2>
            </div>
            <div class="col-lg-6 col-sm-11 d-flex justify-center center-mobile">
                <div class="sign-in mbottom-60" id="login_form">
                    <div class="bg-primary-white p-40">
                        <div class="flex-center mbottom-40">
                            <h1 class="fs-32 fw-800 center-mobile">Masuk</h1>
                            <span class="mleft-20 fs-15 mobile-none" id="login_text">| Login Mahasiswa</span>
                        </div>
                        <form role="form" class="text-start" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h5 class="fs-15 fw-400 mbottom-5">Email</h5>
                            <input class="input-grey no-rounded input-login mbottom-25" name="email"
                                :value="old('email')" type="text" class="mbottom-20">

                            <h5 class="fs-15 fw-400 mbottom-5">Password</h5>
                            <input class="input-grey no-rounded input-login mbottom-10" name="password"
                                type="password" class="mbottom-20">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                            <br />
                            <div id="forget_password" class="text-right fs-14 fp-blue fw-700 auto-mobile forget pointer">Lupa Password</div>
                            <span id="tooltip_pwd">Silahkan Hubungi Admin</span>
                            <button type="submit" class="btn-rounded-lg primary btn-login btn-square-md-mobile mtop-25"></button>
                            {{-- <a href="/home" class="btn-rounded-lg pt-14 pb-14 w-60 primary m-auto btn-square-md-mobile decoration-none"></a> --}}
                        </form>
                        <h5 class="fp-black text-center mtop-25 pointer signup-alumni" onclick="registration_form()">
                            Registrasi Alumni</h5>
                    </div>
                    <div class="role-login bg-primary-black d-flex flex-column p-20 mobile-none">
                        <button class="btn-rounded transparent border-secondary-darkgrey fs-12 fw-400 mbottom-15"
                            onclick="login_title('Alumni')">Masuk sebagai Alumni</button>
                        <button class="btn-rounded transparent border-secondary-darkgrey fs-12 fw-400 mbottom-15"
                            onclick="login_title('Dosen')">Masuk sebagai Dosen</button>
                        <button class="btn-rounded transparent border-secondary-darkgrey fs-12 fw-400"
                            onclick="login_title('Mitra')">Masuk sebagai Mitra</button>
                    </div>
                </div>
                <div id="alumni_form" class="sign-up bg-primary-white rounded-sm p-30 d-none mbottom-60">
                    <div class="close sign-up" onclick="close_form()"></div>
                    <div class="flex-center mbottom-40">
                        <h2 class="fs-18 fw-700">Registrasi Alumni</h2>
                    </div>
                    <form action="" id="create_alumni_form">
                        @csrf
                        <div class="form-white">
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Nama
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <input class="input-grey" type="text" name="name">
                                </div>
                            </div>
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Foto
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <input type="file" name="image">
                                </div>
                            </div>
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    NIM
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <input class="input-grey" type="text" name="phone">
                                </div>
                            </div>
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Jenis Kelamin
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <select name="gender" class="input-grey" id="">
                                        <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="boy">Laki-laki</option>
                                        <option value="girl">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Fakultas
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <select name="faculty_id" class="input-grey" id="">
                                        <option value="" selected disabled>-- Pilih Fakultas --</option>
                                        @foreach (\App\Helpers\Utils::getFaculty() as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Jurusan
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <select name="major_id" class="input-grey" id="">
                                        <option value="" selected disabled>-- Pilih Jurusan --</option>
                                        @foreach (\App\Helpers\Utils::getMajor() as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Tahun Masuk
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <input class="input-grey" type="text" name="year_of">
                                </div>
                            </div>
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Tahun Lulus
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <input class="input-grey" type="text" name="year_graduate">
                                </div>
                            </div>
                            <div class="d-flex mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mtop-10 mbottom-5">
                                    Riwayat Pekerjaan Terakhir
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <textarea class="textarea input-grey mbottom-15" name="history" type="text"></textarea>
                                </div>
                            </div>
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Email
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <input class="input-grey" type="email" name="email">
                                </div>
                            </div>
                            <div class="flex-center mbottom-10 flex-wrap">
                                <div class="col-lg-4 col-sm-12 mbottom-5">
                                    Password
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <input class="input-grey" type="password" name="password">
                                </div>
                            </div>
                            <div class="flex-center-between mtop-50">
                                <h5 onclick="close_form()" class="fp-black fw-700">Login Mahasiswa</h5>
                                <button class="btn-rounded-lg primary btn-rounded">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function registration_form() {
            $("#login_form").addClass('d-none');
            $("#alumni_form").removeClass('d-none');
        }

        function close_form() {
            $("#login_form").removeClass('d-none');
            $("#alumni_form").addClass('d-none');
        }

        function login_title(text) {
            $("#login_text").text(' | Login ' + text);
        }

        $("#create_alumni_form").on("submit", function(event) {
            event.preventDefault();
            var token = $('meta[name="csrf-token"]').attr('content');
            var formData = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                type: 'POST',
                data: formData,
                url: '/register-alumni',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status === true) {
                        swal.fire({
                            text: data.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Berhasil!",
                            customClass: {
                                confirmButton: "btn-rounded primary"
                            }
                        }).then(function() {
                            window.location.assign('/job-articles?type=job_tips');
                        });
                    } else {
                        var values = '';
                        jQuery.each(data.message, function(key, value) {
                            values += value + "<br>";
                        });

                        swal.fire({
                            html: values,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn-rounded danger"
                            }
                        }).then(function() {});
                    }
                }
            });
        });
    </script>
</body>

</html>
