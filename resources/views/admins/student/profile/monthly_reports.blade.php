<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-5">
                <div class="col-lg-3">
                  <div class="card position-sticky top-1">
                      @include('admins.student.profile.menu')
                  </div>
                </div>
                
                <div class="col-lg-9 mt-lg-0">
                  <div class="card">
                    @include('admins.student.profile.profile')
                    <!-- Card header -->
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                @if($page == 'daily-reports')
                                <h5 class="mb-0"> Laporan Harian</h5>
                                @elseif($page == 'weekly-reports')
                                <h5 class="mb-0"> Laporan Mingguan</h5>
                                @elseif($page == 'monthly-reports')
                                <h5 class="mb-0"> Laporan Bulanan</h5>
                                @elseif($page == 'final-reports')
                                <h5 class="mb-0"> Laporan Akhir</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Absensi</th>
                                    <th>Activity</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $item)
                                    <tr>
                                        <td class="text-sm font-weight-normal">
                                            {{ $item->month_date->format('Y-m-d') }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            @if ($item->attendance != null)
                                                In : {{ $item->attendance->checkin == null ? '' : $item->attendance->checkin->format('H:i') }}
                                                <br/>
                                                Out : {{ $item->attendance->checkout == null ? '' : $item->attendance->checkout->format('H:i') }}
                                            @else 
                                              Absen
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
                                                    data-title={{ $item->title }} id="modalShow" onclick="modalDetailReport({{$item}})">
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
        <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-dialog-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail report </h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="py-2 text-start">
                          <span class="text-gradient" id="isApproved"></span>
                          <span class="text-gradient text-dark" id="checkin"></span>
                          <span class="text-gradient text-dark" id="checkout"></span>
                          <h5 class="text-gradient text-dark mt-4" id="title"></h5>
                          <p id="reports"></p>
                          <div class="d-flex justify-content-center mb-3" id="file_report"></div>
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
        <script src="{{url('/custom/admin/student.js')}}" type="application/javascript" ></script>
        <script>
          $(document).ready(function(){
              //$('#datatable-search').dataTable();
              const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
                  searchable: true,
                  fixedHeight: true
              });
          })

          function modalDetailReport(data) {
            
                //console.log(data)
                $('#file_report').html('');
                let title = data.title;
                let is_approved = data.approved_at === null ? false : true;
                let report = data.reports
                // let checkin = data.attendance.checkin
                // let checkout = data.attendance.checkout
               // var datee = formatDate(checkin);
                //console.log(datee)
                if(is_approved){
                    $('#isApproved').addClass('text-success')
                    $('#isApproved').html("Disetujui!")
                } else{
                    $('#isApproved').addClass('text-danger')
                    $('#isApproved').html("Menunggu konfirmasi")
                }
                $('#title').html(title)
                $('#reports').html(report)

                if(data.file.length > 0){
                 data.file.forEach((file) => {
                    let file_type =  file.file.split(".");
                    const image =  ["jpg" , "jpeg" , "png" , "PNG" , "JPEG" , "JPG" ,"webp"];
                    if(image.includes(file_type[1])){
                      //$('#file_report').append('<img src="'+file.file+'" class="avatar avatar-sm me-3" alt="avatar image">')
                      $('#file_report').append('<div class="avatar avatar-xl bg-gradient-dark border-radius-md m-2"><img src="'+file.file+'" alt="asana_logo"></div>')
                    }else{
                      $('#file_report').append('<div class="avatar avatar-xl bg-gradient-dark border-radius-md m-2"><img src="https://s3.ap-southeast-1.amazonaws.com/hotdeal.cdn/hotdeal/upload/vendors/product/627dba7ab8d36.webp" alt="asana_logo"></div>')
                      
                    }
                 })
                 
                }
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
