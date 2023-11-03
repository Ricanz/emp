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
                                    <h5 class="mb-0">{{ $student->name }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                        <th>Aktivitas</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $item)
                                        <tr>
                                            <td class="text-sm font-weight-normal">
                                                {{ $item->intern_date->format('Y-m-d') }}
                                            </td>
                                            <td class="text-sm font-weight-normal">
                                                @if ($item->attendance != null)
                                                    {{ $item->attendance->checkin == null ? '' : $item->attendance->checkin->format('H:i:s') }}
                                                @else 
                                                @endif
                                            </td>
                                            <td class="text-sm font-weight-normal">
                                                @if ($item->attendance != null)
                                                    {{ $item->attendance->checkout == null ? '' : $item->attendance->checkout->format('H:i:s') }}
                                                @else 
                                                @endif
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $item->title }}</td>
                                            <td class="text-sm font-weight-normal">
                                                @if ($item->approved_at != null)
                                                    <span class="badge badge-success badge-sm">Approved
                                                        {{ $item->approved_at }}</span>
                                                @else
                                                    <span class="badge badge-danger badge-sm">Menunggu konfirmasi</span>
                                                @endif
                                            </td>
                                            <td class="text-sm font-weight-normal">
                                                <div class="ms-auto my-auto">
                                                    <button type="button" class="btn bg-gradient-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                        data-title={{ $item->title }} id="modalShow" onclick="myFunction({{$item}})">
                                                        Detail
                                                    </button>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail report </h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="py-2 text-start">
                          <h6 class="text-gradient mt-4" id="isApproved"></h6>
                          <h6 class="text-gradient text-dark mt-4" id="checkin"></h6>
                          <h6 class="text-gradient text-dark mt-4" id="checkout"></h6>
                          <h5 class="text-gradient text-dark mt-4" id="title"></h5>
                          <p id="reports"></p>
                        </div>
                      </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @section('scripts')
        <script>
            function myFunction(data) {
                console.log(data)
                let title = data.title;
                let is_approved = data.approved_at === null ? false : true;
                let report = data.reports
                let checkin = data.attendance.checkin
                let checkout = data.attendance.checkout

                var datee = formatDate(checkin);
                console.log(datee)
                if(is_approved){
                    $('#isApproved').addClass('text-success')
                    $('#isApproved').html("Disetujui!")
                } else{
                    $('#isApproved').addClass('text-danger')
                    $('#isApproved').html("Menunggu konfirmasi")
                }
                $('#title').html(title)
                $('#reports').html(report)
            }

            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear(),
                    hour = d.getHours(),
                    minute = d.getMinutes(),
                    hour = d.getHours();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day, hour, minute].join('-');
            }
        </script>
    @endsection

</x-app-layout>
