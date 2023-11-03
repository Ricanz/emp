<x-guest-layout>
    <div class="container">
        <div class="row mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="card border-primary-grey rounded-sm profile">
                    <form action="" id="change_image_form">
                        @csrf
                        <div class="relative flex-center-between">
                            <img class="profile125" id="preview_alumni_image" src="{{ asset($alumni->image) }}"
                                alt="">
                            <button id="change_image_btn" class="change-img pointer"></button>
                            <input class="upload-profile" type="file" name="image" id="input_alumni_image">
                        </div>

                    </form>
                    <div class="flex-center-between mtop-20">
                        <h5>Nama</h5>
                        <h5 class="fw-400">{{ $alumni->name }}</h5>
                    </div>
                    <div class="border2-secondary-grey mtop-10 mbottom-10 m-auto w-100 rounded-sm"></div>
                    <div class="text-center mtop-10">
                        <h5 class="fw-400">{{ $alumni->email }}</h5>
                    </div>
                    <div class="border-bottom-profile"></div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12 mobile-none">
                <div class="row flex-center-between mbottom-20">
                    <div class="col-lg-6">
                        <a href="{{ url('/job-vacancy-create') }}" class="decoration-none">
                            <div class="card border-primary-grey rounded-sm program">
                                <img width="90" src="{{ asset('/guestAssets/img/ic-learning.svg') }}"
                                    alt="">
                                <span>Pekerjaan</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 pointer" id="_to_students_report_">
                        <a href="{{ url('/schoolarship-create') }}" class="decoration-none">
                            <div class="card border-primary-grey rounded-sm program">
                                <img width="80" src="{{ asset('/guestAssets/img/ic-logbook.svg') }}" alt="">
                                <span>Beasiswa</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#change_image_form").on("submit", function (event) {
            event.preventDefault();
            var token = $('meta[name="csrf-token"]').attr('content');
            var formData = new FormData(this);
            $.ajax({
                headers: { 'X-CSRF-TOKEN': token },
                type: 'POST',
                data: formData,
                url: '/alumni/change/image',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status === true) {
                        swal.fire({
                            text: data.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Berhasil!",
                            customClass: {
                                confirmButton: "btn-rounded primary"
                            }
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        var values = '';
                        jQuery.each(data.message, function (key, value) {
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
                        }).then(function () { });
                    }
                }
            });
        })

        $("#input_alumni_image").on("change", function (event) {
            var total_file = document.getElementById("input_alumni_image").files.length;
            var file_name = event.target.files[0].name
            $('#preview_alumni_image').attr('src', URL.createObjectURL(event.target.files[0]));

            $("#change_image_form").submit();
        })
    </script>
</x-guest-layout>
