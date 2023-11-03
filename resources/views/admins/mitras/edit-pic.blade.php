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
                                    <h5 class="mb-0">Update PIC</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="edit_pic_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Mitra</label>
                                            <input type="text" class="form-control" id="mitra" name="mitra" value="{{ $mitra->name }}" disabled>
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $data->id }}">
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
                                            <label for="name" class="form-control-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image" class="form-control-label">Photo</label>
                                            <input type="file" class="form-control" id="image" name="image" value="{{ $data->image }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone" class="form-control-label">Phone Number</label>
                                            <input type="number" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="status" class="form-control-label">Gender</label>
                                        <div class="form-group" style="display: flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="status1" value="boy" {{ $data->gender == 'boy' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status1">
                                                  Man
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="gender" id="status2" value="girl" {{ $data->gender == 'girl' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status2">
                                                  Woman
                                                </label>
                                              </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $data->user->email }}">
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
                                                <input class="form-check-input" type="radio" name="status" id="status1" value="active" {{ $data->status == 'active' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status1">
                                                  Active
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="status" id="status2" value="inactive" {{ $data->status == 'inactive ' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status2">
                                                  Inactive
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="status" id="status2" value="deleted" {{ $data->status == 'deleted ' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status2">
                                                  Delete
                                                </label>
                                              </div>
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
        <script src="{{url('/custom/admin/mitra.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
