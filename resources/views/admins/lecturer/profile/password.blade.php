<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-5">
                <div class="col-lg-3">
                  <div class="card position-sticky top-1">
                      @include('admins.lecturer.profile.menu')
                  </div>
                </div>
                <div class="col-lg-9 mt-lg-0">
                  <!-- Card Basic Info -->
                  <div class="card" id="basic-info">
                      <div class="card-header">
                        <h5>Ubah Password</h5>
                      </div>
                      <form id="update_password" enctype="multipart/form-data">
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
                          <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-4">Update password</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
              
        </div>
    </main>

    @section('scripts')
        <script src="{{url('/custom/admin/student.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
