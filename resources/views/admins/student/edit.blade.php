<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-5">
                <div class="col-lg-3">
                  <div class="card position-sticky top-1">
                    @include('admins.student.profile.menu')
                  </div>
                </div>
                <div class="col-lg-9 mt-lg-0">
                  <!-- Card Basic Info -->
                  <div class="card" id="basic-info">
                    <div class="card-header">
                      <h5>Profile</h5>
                    </div>
                    <div class="card-body">
                        <form id="edit_student_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">NIM</label>
                                        <input type="text" class="form-control" id="nim" name="nim" value="{{ $student->nim }}">
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $student->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="name" value="{{ $student->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{ $student->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image" class="form-control-label">Photo</label>
                                        <input type="file" class="form-control" id="image" name="image" value="{{ $student->image }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="faculty">Major</label>
                                        <select name="major_id" class="form-control" id="major_id">
                                            <option selected disabled>-- Select Major --</option>
                                            @foreach ($major as $item)
                                                @if($item->id == $student->major_id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="faculty">Mitra</label>
                                        <select name="mitra_id" class="form-control" id="mitra_id">
                                            <option selected disabled>-- Select Mitra --</option>
                                            @foreach ($mitra as $item)
                                                @if($item->id == $student->mitra_id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <span class="nav-link-text ms-1">Internship Periode</span>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date" class="form-control-label">Start Date : {{ $student->start_date->format('d/m/Y') }}</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $student->start_date }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date" class="form-control-label">End Date : {{ $student->end_date->format('d/m/Y') }}</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $student->end_date }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="faculty">Dosen PA</label>
                                        <select name="dpa" class="form-control" id="dpa">
                                            <option selected disabled>-- Select DPA --</option>
                                            @foreach ($dpa as $item)
                                                @if($item->id == $student->dpa)
                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="faculty">Dosen PL</label>
                                        <select name="dpl" class="form-control" id="dpl">
                                            <option selected disabled>-- Select DPL --</option>
                                            @foreach ($dpl as $item)
                                            @if($item->id == $student->dpl)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Phone</label>
                                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $student->phone }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-control-label">Gender</label>
                                    <div class="form-group" style="display: flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="boy" {{ ($student->gender=='boy') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="girl" {{ ($student->gender=='girl') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender2">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-control-label">Status</label>
                                    <div class="form-group" style="display: flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status1" value="active" {{ ($student->status=='active') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="inactive" {{ ($student->status=='inactive') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status2">
                                                Inactive
                                            </label>
                                        </div>
                                        <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="status" id="status3" value="deleted" {{ ($student->status=='deleted') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status3">
                                                Delete
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
        <script src="{{url('/custom/admin/student.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
