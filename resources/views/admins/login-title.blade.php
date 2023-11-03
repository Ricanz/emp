<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header pb-0 mb-3">
                            <div class="d-lg-flex">
                                <div>
                                    <h5 class="mb-0">Atur Judul Halaman Login</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_final_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Tahun Ajar</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $title->title }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Sub Judul</label>
                                            <input type="text" class="form-control" id="sub" name="sub" value="{{ $title->description }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @section('scripts')
        <script src="{{url('/custom/admin/admin.js')}}" type="application/javascript" ></script>
        <script>
            $("#create_final_form").on("submit", function(event) {
                event.preventDefault();
                var token = $('meta[name="csrf-token"]').attr('content');
                var formData = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    type: 'POST',
                    data: formData,
                    url: '/admin/login/title',
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
                                confirmButtonText: "Berhasil",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                location.reload()
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
    @endsection
</x-app-layout>
