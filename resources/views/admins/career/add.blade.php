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
                                    <h5 class="mb-0">Tambah {{$title}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_info_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Judul</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                            <input type="hidden" class="form-control" value="{{$type}}" name="type">
                                            <input type="hidden" class="form-control" value="{{$cate->id}}" name="category">
                                        </div>
                                    </div>
                                    @if($type == 'job' || $type == 'shcoolarship')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Nama Perusahaan</label>
                                            <input type="text" class="form-control"  name="company">
                                        </div>
                                    </div>
                                    @endif

                                    @if($type == 'job')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Lokasi</label>
                                            <select class="form-control form-control-sm" name="location">
                                                <option>- Pilih Lokasi-</option>
                                                @foreach($locations as $location)
                                                    <option value="{{$location->id}}">{{$location->location}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    @if($type == 'job')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Tanggal Berakhir</label>
                                            <input class="form-control" type="date" name="end_date" >
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image" class="form-control-label">Gambar</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-control-label">Description</label> <br>
                                            <div id="editor" style="min-height: 100px"></div>
                                            {{-- <textarea id="summernote" name="description"cols="20" rows="7"></textarea> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        {{-- <label for="status" class="form-control-label">update_alumni_status</label> --}}
                                        <div class="form-group" style="display: flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1" value="approved" >
                                                <label class="form-check-label" for="status1">
                                                    Posting
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="status" id="status2" value="pending" checked>
                                                <label class="form-check-label" for="status2">
                                                    Pending
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                                        <a href="{{url()->previous()}}" class="btn">Batal</a>
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
    <script src="../../../assets/js/plugins/quill.min.js"></script>
    @endsection

</x-app-layout>

<script>    

// $(document).ready(function() {
//   $('#summernote').summernote();
// });
if (document.getElementById('editor')) {
    var quill = new Quill('#editor', {
    theme: 'snow' // Specify theme in configuration
    });
}


$("#create_info_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    formData.append('description' , $('.ql-editor').html());
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        data: formData,
        url: '/admin/career/store',
        dataType: 'JSON',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if(data.status == 'success'){
                swal.fire({
                text: data.message,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Close",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-danger"
                }
                }).then(() => {
                    location.reload();
                })
            }else{
                swal.fire({
                text: data.message,
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Close",
                customClass: {
                        confirmButton: "btn font-weight-bold btn-light-danger"
                    }
                })
            }
        }
    });
    
});

</script>
