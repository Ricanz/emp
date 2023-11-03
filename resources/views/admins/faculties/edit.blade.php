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
                                    <h5 class="mb-0">Edit Faculty</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="edit_faculty_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Faculty</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $faculty->name }}">
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $faculty->id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-control-label">Description</label> <br>
                                            <textarea name="description" class="form-control" id="description" name="description" cols="20" rows="7">
                                                {{ $faculty->description }}
                                            </textarea>
                                            {{-- <div id="editor">
                                                <p>Hello World!</p>
                                                <p>Some initial <strong>bold</strong> text</p>
                                                <p><br></p>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="status" class="form-control-label">Status</label>
                                        <div class="form-group" style="display: flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1" value="active" {{ $faculty->status == 'active' ? 'checked' : ''  }}>
                                                <label class="form-check-label" for="status1">
                                                  Active
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="status" id="status2" value="inactive" {{ $faculty->status == 'inactive' ? 'checked' : ''  }}>
                                                <label class="form-check-label" for="status2">
                                                  Inactive
                                                </label>
                                              </div>
                                              <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="status" id="status3" value="deleted" {{ $faculty->status == 'deleted' ? 'checked' : ''  }}>
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
        <script src="{{ asset('../../assets/js/plugins/quill.min.js') }}"></script>
        <script src="{{url('/custom/admin/faculty.js')}}" type="application/javascript" ></script>
        {{-- <script>
            var quill = new Quill('#editor', {
                theme: 'snow' // Specify theme in configuration
            });
        </script> --}}
    @endsection
</x-app-layout>
