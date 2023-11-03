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
                                    <h5 class="mb-0">Weekly Report</h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="{{ url('/admin/student/create') }}"
                                            class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Student</a>
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
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>
                                                <div>
                                                    <a href="{{ url('/admin/student/edit/' . $item->student_id) }}">
                                                        <h6 class="my-auto">{{ $item->name }}</h6>
                                                    </a>
                                                    <a href="{{ url('/admin/mitras/edit/' . $item->student_id) }}">
                                                        <span class="my-auto">{{ $item->mitra }}</span>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $item->nim }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->start_date }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->end_date }}</td>
                                            <td class="text-sm font-weight-normal">
                                                <div class="ms-auto my-auto">
                                                    <a href="{{ url('/admin/report/daily/detail/'. $item->student_id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0">+&nbsp; View Reports</a>
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
