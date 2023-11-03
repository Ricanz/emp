<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header pb-0">
                            <div class="d-lg-flex">
                                <div>
                                    <h5 class="mb-0">Daftar Mahasiswa</h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="{{ url('/admin/student/create') }}"
                                            class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Tambah Mahasiswa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>NIM</th>
                                        <th>Major</th>
                                        <th>Mitra</th>
                                        <th>Dosen PA</th>
                                        <th>Dosen PL</th>
                                        <th>Modified At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <img class="w-10 ms-3"
                                                    src="{{ asset($item->image) }}"
                                                    alt="">
                                                    <a href="{{ url('/admin/student/edit/' . $item->id . '/profile') }}">
                                                        <h6 class="ms-3 my-auto">{{ $item->name }}</h6>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $item->nim ?? ''}}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->major->name ?? '' }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->mitra->name ?? ''}}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->dosen_pa->name ?? ''}}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->dosen_pl->name ?? ''}}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->updated_at ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @section('scripts')
        <script src="{{url('/custom/admin/faculty.js')}}" type="application/javascript" ></script>
    @endsection

</x-app-layout>
