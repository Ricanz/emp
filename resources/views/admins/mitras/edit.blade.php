<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-5">
                <div class="col-lg-3">
                  <div class="card position-sticky top-1">
                    @include('admins.mitras.profile.menu')
                  </div>
                </div>
                <div class="col-lg-9 mt-lg-0">
                  <!-- Card Basic Info -->
                  <div class="card" id="basic-info">
                    <div class="card-header">
                      <h5>Profile</h5>
                    </div>
                    <div class="card-body">
                        <form id="edit_mitra_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Mitra Name</label>
                                        <input type="text" class="form-control" id="email" name="name" value="{{ $mitra->name }}">
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $mitra->id }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image" class="form-control-label">Mitra Image</label>
                                        <input type="file" class="form-control" id="image" name="image" value="{{ $mitra->image }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="form-control-label">Description</label> <br>
                                        <textarea name="description" class="form-control" id="description" name="description" cols="20" rows="7">{{ $mitra->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">Phone Number</label>
                                        <input type="number" class="form-control" id="phone" name="phone" value="{{ $mitra->phone }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="form-control-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $mitra->address }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="status" class="form-control-label">Status</label>
                                    <div class="form-group" style="display: flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status1" value="active" {{ $mitra->status == 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status1">
                                              Active
                                            </label>
                                          </div>
                                          <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="inactive" {{ $mitra->status == 'inactive' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status2">
                                              Inactive
                                            </label>
                                          </div>
                                          <div class="form-check ms-4">
                                            <input class="form-check-input" type="radio" name="status" id="status3" value="deleted" {{ $mitra->status == 'deleted' ? 'checked' : '' }}>
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
    <script src="{{url('/custom/admin/mitra.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
