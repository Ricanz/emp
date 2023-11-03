<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-5">
                <div class="col-lg-3">
                  <div class="card position-sticky top-1">
                    @include('admins.alumni.profile.menu')
                  </div>
                </div>
                <div class="col-lg-9 mt-lg-0">
                  <!-- Card Basic Info -->
                  <div class="card" id="basic-info">
                    <div class="card-header">
                      <h5>Profile</h5>
                    </div>
                    <div class="card-body">
                        <form  id="update_alumni_data" data-id="{{ $alumni->id }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Nama</label>
                                        <input type="text" class="form-control" id="email" name="name" value="{{ $alumni->name }}">
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $alumni->id }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{ $alumni->email }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image" class="form-control-label">Alumni Image</label>
                                        <input type="file" class="form-control" id="image" name="image" value="{{ $alumni->image }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="form-control-label">Address</label> <br>
                                        <textarea name="description" class="form-control" id="description" name="description" cols="20" rows="7">{{ $alumni->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">NIM</label>
                                        <input type="number" class="form-control" id="phone" name="phone" value="{{ $alumni->phone }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="status" class="form-control-label">Jenis Kelamin</label>
                                    <div class="form-group" style="display: flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="boy" {{ $alumni->gender == 'boy' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender1">
                                              Laki-Laki
                                            </label>
                                          </div>
                                          <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="girl" {{ $alumni->gender == 'girl' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender2">
                                              Perempuan
                                            </label>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="status" class="form-control-label">Status {{$alumni->status}} </label>
                                    <div class="form-group" style="display: flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status1" value="active" {{ $alumni->status == 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status1">
                                              Active
                                            </label>
                                          </div>
                                          <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="inactive" {{ $alumni->status == 'inactive' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status2">
                                              Inactive
                                            </label>
                                          </div>
                                          <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="status" id="status3" value="deleted" {{ $alumni->status == 'deleted' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status3">
                                              Delete
                                            </label>
                                          </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="status" class="form-control-label">Approve</label>
                                    <div class="form-group" style="display: flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_approve" id="approve1" value="active" {{ $alumni->is_approved == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="approve1">
                                                Telah di approve
                                            </label>
                                          </div>
                                          <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="is_approve" id="approve2" value="inactive" {{ $alumni->is_approved == false ? 'checked' : '' }}>
                                            <label class="form-check-label" for="approve2">
                                              Belum di approve
                                            </label>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-gradient-primary">Update</button>
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
    <script src="{{url('/custom/admin/mitra.js')}}" type="application/javascript" ></script>
    <script>
        $("#update_alumni_data").on("submit", function (event) {
            // let id = $(this).attr('data-id');
            event.preventDefault();
            var token = $('meta[name="csrf-token"]').attr('content');
            var formData = new FormData(this);
            formData.append('description' , $('.ql-editor').html());
            $.ajax({
                headers: { 'X-CSRF-TOKEN': token },
                type: 'POST',
                data: formData,
                url: '/admin/alumni/update',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status === 'success') {
                        swal.fire({
                            text: data.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Berhasil!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-primary"
                            }
                        }).then(function () {
                            // location.href('/admin/alumni');
                            window.location.assign('/admin/alumni');
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
    </script>
    @endsection
</x-app-layout>
