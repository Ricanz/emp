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
                                    <h5 class="mb-0">Form Rubrik Penilaian</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_final_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Penilaian Dosen</label>
                                            <input type="file" class="form-control" id="lecturer" name="lecturer">
                                        </div>
                                    </div>
                                    @if ($lecturer->file != '')
                                        <div class="col-md-12 mb-4">
                                            <a href="{{ url('/'.$lecturer->file) }}" target="_blank">
                                                <span>Lihat Form</span>
                                            </a>
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Penilaian Mitra</label>
                                            <input type="file" class="form-control" id="mitra" name="mitra">
                                        </div>
                                    </div>
                                    @if ($mitra->file != '')
                                        <div class="col-md-12 mb-4">
                                            <a href="{{ url('/'.$mitra->file) }}" target="_blank">
                                                <span>Lihat Form</span>
                                            </a>
                                        </div>
                                    @endif
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
        <script src="{{ asset('../../assets/js/plugins/quill.min.js') }}"></script>
        <script src="{{url('/custom/admin/admin.js')}}" type="application/javascript" ></script>
        {{-- <script>
            var quill = new Quill('#editor', {
                theme: 'snow' // Specify theme in configuration
            });
        </script> --}}
    @endsection
</x-app-layout>
