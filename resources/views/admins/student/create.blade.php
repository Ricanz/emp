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
                                    <h5 class="mb-0">Tambah mahasiswa baru</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_student_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email" class="form-control-label">NIM</label>
                                                <input type="text" class="form-control" id="nim" name="nim">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email" class="form-control-label">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email" class="form-control-label">Email</label>
                                                <input type="text" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email" class="form-control-label">Telepon/Handphone</label>
                                                <input type="text" class="form-control" id="no_telp" name="no_telp">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password" class="form-control-label">Password</label>
                                                <input type="text" class="form-control" id="password" name="password">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password_confirmation" class="form-control-label">Konfirmasi Password</label>
                                                <input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="image" class="form-control-label">Photo</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="status" class="form-control-label">Jenis Kelamin</label>
                                            <div class="form-group" style="display: flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" id="status1" value="girl" checked>
                                                    <label class="form-check-label" for="status1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check ms-4">
                                                    <input class="form-check-input" type="radio" name="gender" id="status2" value="boy">
                                                    <label class="form-check-label" for="status2">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="faculty">Major</label>
                                                <select name="major_id" class="form-control" id="major_id">
                                                    <option selected disabled>-- Select Major --</option>
                                                    @foreach ($major as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="faculty">Mitra</label>
                                                <select name="mitra_id" class="form-control" id="mitra_id">
                                                    <option selected disabled>-- Pilih Mitra --</option>
                                                    @foreach ($mitra as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <span class="nav-link-text ms-1">Periode magang</span>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="start_date" class="form-control-label">Mulai magang</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="end_date" class="form-control-label">Berakhir</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="faculty">Dosen PA</label>
                                                <select name="dpa" class="form-control" id="dpa">
                                                    <option selected disabled>-- Select DPA --</option>
                                                    @foreach ($dpa as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="faculty">Dosen PL</label>
                                                <select name="dpl" class="form-control" id="dpl">
                                                    <option selected disabled>-- Select DPL --</option>
                                                    @foreach ($dpl as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="col-md-12">
                                            <label for="status" class="form-control-label">Is Alumni?</label>
                                            <div class="form-group" style="display: flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_alumni" id="status1" value="true">
                                                    <label class="form-check-label" for="status1">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check ms-4">
                                                    <input class="form-check-input" type="radio" name="is_alumni" id="status2" value="false" checked>
                                                    <label class="form-check-label" for="status2">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email" class="form-control-label">History</label>
                                                <textarea name="history" id="history" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                                        <a href="{{url()->previous()}}" type="submit" class="btn bg-default">Batal</a>
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
