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
                                    <h5 class="mb-0"> {{$title}} </h5>
                                </div>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="{{ url('/admin/career/add/') }}/{{$type}}"
                                            class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Tambah</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>status</th>
                                        <th>Diposting Oleh</th>
                                        <th>Tanggal</th>
                                        <th class="image_table">gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data) > 0)
                                        @foreach ($data as $item)
                                            <tr>
                                                
                                                <td class="text-sm font-weight-normal">
                                                    <a href="{{ url('/admin/career/edit/'.$item->id.'/'.$type) }}">
                                                        <h6 class="ms-3 my-auto">{{ $item->title }}</h6>
                                                    </a>
                                                </td>
                                                <td class="text-sm font-weight-normal"><span style="width: 100px;">{{ substr( strip_tags($item->description) , 0 , 255) }}</span></td>
                                                <td class="text-sm font-weight-normal">{{ $item->status }}</td>
                                                <td class="text-sm font-weight-normal">{{ $item->created_by }}</td>
                                                <td class="text-sm font-weight-normal">{{ $item->created_at }}</td>
                                                <td class="text-sm font-weight-normal">
                                                    <img class="" width="100%" src="{{ url($item->image) }}" alt="">
                                                </td>
                                            </tr>
                                        @endforeach
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
        <script src="{{url('/custom/admin/faculty.js')}}" type="application/javascript" ></script>
    @endsection

</x-app-layout>
