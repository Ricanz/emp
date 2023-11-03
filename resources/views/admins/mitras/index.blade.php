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
                                    <h5 class="mb-0">Daftar Mitra </h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="{{ url('/admin/mitras/create') }}"
                                            class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Tambah Mitra</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Mitra Name</th>
                                        <th>Status</th>
                                        <th>Address</th>
                                        <th>Modified By</th>
                                        <th>Modified At</th>
                                        <th>PIC</th>
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
                                                    <a href="{{ url('/admin/mitras/edit/' . $item->id . '/profile') }}">
                                                        <h6 class="ms-3 my-auto">{{ $item->name }}</h6>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $item->status }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->address }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->updated_by }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->updated_at }}</td>
                                            <td class="text-sm">
                                                <div class="ms-auto my-auto">
                                                    <a href="{{ url('/admin/mitra/manage/pic/'. $item->id) }}"
                                                        class="btn bg-gradient-warning btn-sm mb-0">+&nbsp; Manage PIC</a>
                                                </div>
                                            </td>
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
