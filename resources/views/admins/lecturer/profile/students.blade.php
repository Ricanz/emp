<x-app-layout>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <div class="container-fluid py-4">
          <div class="row mb-5">
              <div class="col-lg-3">
                <div class="card position-sticky top-1">
                    @include('admins.lecturer.profile.menu')
                </div>
              </div>
              <div class="col-lg-9 mt-lg-0">
                <!-- Card Basic Info -->
                <div class="card">
                  <!-- Card header -->
                  <div class="card-header pb-0">
                      <div class="d-lg-flex">
                          <div>
                              <h5 class="mb-0">Daftar Mahasiswa</h5>
                          </div>
                          <div class="ms-auto my-auto mt-lg-0 mt-4">
                              <div class="ms-auto my-auto">
                                  {{-- <a href="{{ url('/admin/student/create') }}"
                                      class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Student</a> --}}
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="table-responsive">
                      <table class="table table-flush" id="dt_mahasiswa">
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
                            @if(count($students) > 0)
                              @foreach ($students as $item)
                                  <tr>
                                      <td>
                                          <div class="d-flex">
                                              <img class="w-10 ms-3"
                                              src="{{ asset($item->image) }}"
                                              alt="">
                                              <a href="/admin/student/edit/{{$item->id}}/profile">
                                                  <h6 class="ms-3 my-auto">{{ $item->name }}</h6>
                                              </a>
                                          </div>
                                      </td>
                                      <td class="text-sm font-weight-normal">{{ $item->nim }}</td>
                                      <td class="text-sm font-weight-normal">{{ $item->major->name }}</td>
                                      <td class="text-sm font-weight-normal">{{ $item->mitra->name }}</td>
                                      <td class="text-sm font-weight-normal">{{ $item->dosen_pa->name }}</td>
                                      <td class="text-sm font-weight-normal">{{ $item->dosen_pl->name }}</td>
                                      <td class="text-sm font-weight-normal">{{ $item->updated_at }}</td>
                                  </tr>
                              @endforeach
                            @else
                            <tr>
                              <td colspan="6"> Mahasiswa belum tersedia. </td>
                          </tr>
                            @endif
                          </tbody>
                      </table>
                  </div>
              </div>
              </div>
            </div>
            
      </div>
  </main>

  @section('scripts')
    <script src="{{url('/custom/admin/lecturer.js')}}" type="application/javascript" ></script>
 <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="application/javascript" ></script>
  <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
  <script>
    $(document).ready(function(){
        init_data_table()
        //init_data_table();
    });

    function init_data_table() {
        const dataTableSearch = new simpleDatatables.DataTable("#dt_mahasiswa", {
            searchable: true,
            fixedHeight: true
        });
    }

    //  function init_data_table(){
    //     let table = $('#dt_mahasiswa');
    //     var token = $('input[name="_token"]').val();
    //     if (table != null) {
    //         table.dataTable({
    //             responsive: true,
    //             processing: true,
    //             serverSide: true,
    //             ajax: {
    //                 url: '/student/by/mitra',
    //                 type:"POST",
    //                 data: function ( d ) {
    //                     d._token = token;
    //                     d.id = {{$id}};
    //                 }
    //             },
    //             columns: [
    //                 { data: 'name', name: 'name' },
    //                 { data: 'nim', name: 'nim' },
    //                 { data: 'phone', name: 'phone' },
    //                 { data: 'email', name: 'email' },
    //                 { data: 'gender', name: 'gender' },
    //                 { data: 'updated_at', name: 'updated_at' },
    //             ],
    //             columnDefs: [
    //                 {
    //                     targets: 0,
    //                     render:function (data, type, full, meta){
    //                         return '<td><div class="d-flex px-2 py-1"><div><img src="'+full.image+'" class="avatar avatar-sm me-3"></div><div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-xs">'+full.name+'</h6><p class="text-xs text-secondary mb-0">'+full.email+'</p></div></div></td>'
    //                     }
    //                 },
    //                 {
    //                     targets : 1,
    //                     render : function(data){
    //                         return '<td><p class="text-xs font-weight-bold mb-0">'+data+'</p></td>';
    //                     }
    //                 },
    //                 {
    //                     targets : 2,
    //                     render : function(data){
    //                         return '<td><p class="text-xs font-weight-bold mb-0">'+data+'</p></td>';
    //                     }
    //                 },
    //                 {
    //                     targets : 3,
    //                     render : function(data){
    //                         return '<td><p class="text-xs font-weight-bold mb-0">'+data+'</p></td>';
    //                     }
    //                 },
    //                 {
    //                     targets : 4,
    //                     render : function(data){
    //                         return '<td><p class="text-xs font-weight-bold mb-0">'+data+'</p></td>';
    //                     }
    //                 },
    //                 {
    //                     targets : 5,
    //                     render : function(data){
    //                         return ' <span class="badge badge-sm badge-secondary">'+data+'</span>';
    //                     }
    //                 }
    //             ]
    //         })
    //     }
    // }

  </script> 
@endsection
</x-app-layout>
