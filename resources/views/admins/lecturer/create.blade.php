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
                                    <h5 class="mb-0">Create Lecturer</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_lecturer_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nidn" class="form-control-label">NIDN</label>
                                            <label for="nidn" class="form-check-label">*opsional</label>
                                            <input type="text" class="form-control" id="nidn" name="nidn">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image" class="form-control-label">Photo</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone" class="form-control-label">Phone Number</label>
                                            <input type="number" class="form-control" id="phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="status" class="form-control-label">Role</label>
                                        <div class="form-group" style="display: flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="role" id="status1" value="dpa" checked>
                                                <label class="form-check-label" for="status1">
                                                  Dosen PA
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="role" id="status2" value="dpl">
                                                <label class="form-check-label" for="status2">
                                                  Dosen PL
                                                </label>
                                              </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="status" class="form-control-label">Gender</label>
                                        <div class="form-group" style="display: flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="status1" value="boy" checked>
                                                <label class="form-check-label" for="status1">
                                                  Man
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="gender" id="status2" value="girl">
                                                <label class="form-check-label" for="status2">
                                                  Woman
                                                </label>
                                              </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="status" class="form-control-label">Status</label>
                                        <div class="form-group" style="display: flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1" value="active" checked>
                                                <label class="form-check-label" for="status1">
                                                  Active
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="status" id="status2" value="inactive">
                                                <label class="form-check-label" for="status2">
                                                  Inactive
                                                </label>
                                              </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password" class="form-control-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary">Create</button>
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
        <script src="{{url('/custom/admin/lecturer.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
