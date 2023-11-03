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
                                    <h5 class="mb-0">Majors List</h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="{{ url('/admin/majors/create') }}"
                                            class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Major</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Faculty</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Modified By</th>
                                        <th>Modified At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-sm font-weight-normal">{{ $item->name }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->faculty->name }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->status }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->created_by }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->updated_by }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->updated_at }}</td>
                                            <td class="text-sm">
                                                <a href="{{ url('/admin/majors/edit/' . $item->id) }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Ubah fakultas">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
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
