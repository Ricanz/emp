<x-app-layout>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <div class="container-fluid py-4">
          <div class="row mb-5">
              <div class="col-lg-3">
                <div class="card position-sticky top-1">
                    @include('admins.alumni.profile.menu')
                </div>
              </div>
              <div class="col-lg-9 mt-lg-0">
                <!-- Card Basic Info -->
                <div class="card">
                    @csrf
                    <div class="card-body p-3">
                            @if(count($posts) > 0)
                            <ul class="list-group">
                                @foreach($posts as $post)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                    <div class="row col-lg-12">
                                        <div class="avatar me-3 col-lg-3">
                                            <img src="{{$post->image}}" alt="kal" class="border-radius-lg shadow">
                                        </div>
                                        <div class=" col-lg-9 d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$post->title}} <span class="badge bg-gradient-info">{{$post->category->category}}</span></h6>
                                            <p class="mb-0 text-xs">{{substr(strip_tags($post->description),0, 255)}}</p>
                                        </div>
                                        <div class="col-lg-1  d-flex">
                                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Lihat</a>
                                            @if($post->type == 'pending')
                                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;" onclick="posting_post({{$post->id}} , 'approve')">Approve</a>
                                            @else
                                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto primary" href="javascript:;" onclick="posting_post({{$post->id}} , 'pending')">Disapprove</a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <ul class="list-grou align-item-center">
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                    <div class="row col-lg-12 align-items-center">
                                        <span>Belum ada postingan</span>
                                    </div>
                                </li>
                            </ul>
                            @endif
                      </div>
                </div>
              </div>
            </div>
            
      </div>
  </main>

  @section('scripts')
    {{-- <script src="{{url('/custom/admin/faculty.js')}}" type="application/javascript" ></script> --}}
  @endsection
</x-app-layout>

<script>
    var token = $('input[name="_token"]').val();
   
    function posting_post(id , status){
        Swal.fire({
            title: 'Update status Posting?',
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
                data: { id:id , token : token , status:status},
                url: '/admin/alumni/post/update',
                dataType: 'JSON',
                success: function (data) {
                    Swal.fire(
                        data.status+' !',
                        data.message,
                        data.status,
                    ).then((result) => {
                        if(result.isConfirmed){
                            location.reload()
                        }
                    })
                }
                
            });
        }
        })
    }
</script>