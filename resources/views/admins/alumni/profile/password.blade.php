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
                        <h5>Change Password</h5>
                      </div>
                      <form id="update_password_alumni" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" name="user_id" type="hidden" value="{{$id}}" placeholder="New password">
                        <div class="card-body pt-0">
                          <label class="form-label">Password</label>
                          <div class="form-group">
                            <input class="form-control" name="password" type="password" placeholder="New password">
                          </div>
                          <label class="form-label">Konfirmasi password</label>
                          <div class="form-group">
                            <input class="form-control" name="password_confirmation" type="password" placeholder="Confirm password">
                          </div>
                          <h5 class="mt-5">Password requirements</h5>
                          <p class="text-muted mb-2">
                            Please follow this guide for a strong password:
                          </p>
                          <ul class="text-muted ps-4 mb-0 float-start">
                            <li>
                              <span class="text-sm">Min 6 karakter</span>
                            </li>
                            <li>
                              <span class="text-sm">Terdiri dari huruf besar dan angka.</span>
                            </li>
                          </ul>
                          <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
              
        </div>
    </main>

    @section('scripts')
        {{-- <script src="{{url('/custom/admin/student.js')}}" type="application/javascript" ></script> --}}

        <script>
        
$("#update_password_alumni").on("submit", function (e) {
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/admin/alumni/update/password',
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
                    confirmButtonText: "Close",
                    customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
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
                    confirmButtonText: "Close",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function () { });
            }
        }
    });
});
        </script>
      @endsection
</x-app-layout>
