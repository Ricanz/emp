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
                                    <h5 class="mb-0">Daftar Alumni </h5>
                                </div>
                                {{-- <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="{{ url('/admin/mitras/create') }}"
                                            class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Tambah Mitra</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Angkatan</th>
                                        <th>Jenis Kelamin</th>
                                        {{-- <th>Alamat</th> --}}
                                        <th>Status</th>
                                        <th>NIM</th>
                                        <th></th>
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
                                                    <a href="{{ url('/admin/alumni/edit/' . $item->id . '/profile') }}">
                                                        <h6 class="ms-3 my-auto">{{ $item->name }}</h6>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $item->email }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->email }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->gender == 'boy' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                            {{-- <td class="text-sm font-weight-normal">{{ $item->address }}</td> --}}
                                            <td class="text-sm font-weight-normal">{{ $item->status == true ? 'Aktif' : '' }}</td>
                                            <td class="text-sm font-weight-normal">{{ $item->phone }}</td>
                                            <td class="text-sm">
                                                @if($item->is_approved == false)
                                                <div class="ms-auto my-auto update_email_{{$item->id}}">
                                                    <button class="btn btn-success btn-sm mb-0" onclick="update_alumni_status({{$item->id}})">Setujui</button>
                                                </div>
                                                @endif
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
<script>
    var token = $('input[name="_token"]').val();
   
    function update_alumni_status(id){
        Swal.fire({
            title: 'Update status Alumni?',
            text: "Proses tidak dapat dicancel ketika proses berlangsung!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Proses!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': token },
                type: 'POST',
                data: {id:id , token : token},
                url: '/admin/alumni/update',
                dataType: 'JSON',
                success: function (data) {
                    Swal.fire(
                        data.status+' !',
                        data.message,
                        data.status
                    )
                    if(data.status == 'success'){
                        $('.update_email_'+id).remove()
                    }
                }
                
            });
        }
        })
    }
</script>