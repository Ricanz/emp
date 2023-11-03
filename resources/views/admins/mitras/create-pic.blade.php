<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-5 d-flex">
                {{-- <div class="col-lg-3">
                  <div class="card position-sticky top-1">
                      @include('admins.mitras.profile.menu')
                  </div>
                </div> --}}
                <div class="col-lg-12 mt-lg-0">
                  <!-- Card Basic Info -->
                  <div class="card">
                      @include('admins.mitras.profile.profile')
                        <!-- Card header -->
                        <div class="card-header pb-0 mb-3">
                            <div class="d-lg-flex">
                                <div>
                                    <h5 class="mb-0">Tambah PIC Mentor</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_pic_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Mitra</label>
                                            <input type="text" class="form-control" id="mitra" name="mitra" value="{{ $mitra->name }}" disabled>
                                            <input type="hidden" class="form-control" id="mitra_id" name="mitra_id" value="{{ $mitra->id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="faculty">Student</label>
                                            <select name="student_id" class="form-control" id="student_id">
                                                <option selected disabled>-- Select Student --</option>
                                                @foreach ($students as $item)
                                                    @if($item->id == $mitra->student_id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">PIC Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
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
                                        <label for="status" class="form-control-label">Gender</label>
                                        <div class="form-group" style="display: flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="boy" checked>
                                                <label class="form-check-label" for="gender1">
                                                  Man
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="girl">
                                                <label class="form-check-label" for="gender2">
                                                  Woman
                                                </label>
                                              </div>
                                        </div>
                                    </div>
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
                                    <div class="col-md-3">
                                        <button type="submit" class="btn bg-gradient-primary">Tambah</button>
                                        <a href="{{ url()->previous() }}" type="submit" class="btn bg-default pl-10">Batal</a>
                                    </div>
                                    <div class="col-md-3">
                                        
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
    @endsection
  </x-app-layout>