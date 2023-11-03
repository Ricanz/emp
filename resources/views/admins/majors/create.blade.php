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
                                    <h5 class="mb-0">Create Major</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_major_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="faculty">Faculty</label>
                                            <select name="faculty_id" class="form-control" id="faculty">
                                              <option selected disabled>-- Select Faculty --</option>
                                              @foreach ($faculties as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>  
                                              @endforeach
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Major</label>
                                            <input type="text" class="form-control" id="email" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-control-label">Description</label> <br>
                                            <textarea name="description" class="form-control" id="description" name="description" cols="20" rows="7"></textarea>
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
        <script src="{{url('/custom/admin/major.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>
