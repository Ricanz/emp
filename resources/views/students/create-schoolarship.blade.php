<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="side-menu-log">
                    <button class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15">Posting Beasiswa</button>
                    <div class="rounded-sm border-primary-grey pt-30 pb-30 pr-20 pl-20">
                        <h5 class="fp-black text-center mbottom-20">Cari Beasiswa</h5>
                        <div class="search-component mbottom-15">
                            <form action="/schoolarship">
                            <img width="20" src="{{ asset('/guestAssets/img/search.svg') }}" alt="">
                            <input class="w-100" placeholder="Cari Beasiswa" name="search" type="search">
                            </form>
                        </div>
                        <ul class="article-list">
                            @foreach ($schoolarships as $item)
                                <li>
                                    <a href="{{ url('/schoolarship-details/'.$item->slug) }}" class="decoration-none">
                                        <h5 class="text-ellipsis-2">{{ $item->title }}</h5>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log">
                    <div class="table-responsive">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                            <span class="fw-600 fp-white">Beasiswa</span>
                        </div>
                        <div class="create-post border-primary-grey rounded-sm p-25">
                            <h5 class="mbottom-40">Posting Info Beasiswa</h5>
                            <form id="create_shcolarship_form">
                                @csrf
                                <div class="row mbottom-15 flex-wrap">
                                    <div class="col-lg-3 no-gutter col-sm-12 mbottom-10-mobile">
                                        <h5>Judul Postingan</h5>
                                    </div>
                                    <div class="col-lg-9 no-gutter col-sm-12">
                                        <input class="input-grey" type="text" name="title">
                                    </div>
                                </div>
                                <div class="row mbottom-15 flex-wrap">
                                    <div class="col-lg-3 no-gutter col-sm-12 mbottom-10-mobile">
                                        <h5>Nama Beasiswa</h5>
                                    </div>
                                    <div class="col-lg-9 no-gutter col-sm-12">
                                        <input class="input-grey" type="text" name="name">
                                    </div>
                                </div>
                                <div class="row mbottom-35 flex-wrap">
                                    <div class="col-lg-3 no-gutter col-sm-12 mbottom-10-mobile">
                                        <h5>Deskripsi Beasiswa</h5>
                                    </div>
                                    <div class="col-lg-9 no-gutter col-sm-12">
                                        <div id="editor"></div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row mbottom-35 flex-wrap">
                                    <div class="col-lg-3 col-sm-12 mbottom-10-mobile">
                                        <h5>Banner Beasiswa</h5>
                                    </div>
                                    <div class="col-lg-9 col-sm-12">
                                        <div class="upload-file none-mtop pointer">
                                            <h5 class="fw-700 fp-blue">Upload Banner Beasiswa</h5>
                                            <input class="input-file h-100" id="input_banner_schoolarship" name="file" onchange="schoolarship_banner()" type="file" accept=".jpg, .jpeg, .png" />
                                            <img id="schoolarship_banner_preview" class="container-img-preview flex-center image-uploaded w-40 rounded-md" src="{{ asset('guestAssets/img/dummy-image.svg') }}" alt="your image" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn-rounded-lg primary mleft-auto">Posting</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    @section('scripts')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="{{url('/custom/guest/schoolarship.js')}}" type="application/javascript" ></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    @endsection
</x-guest-layout>

<script>
$(document).ready(function(){
if (document.getElementById('editor')) {
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
}
})

var loadFile2 = function(event) {
    var output = document.getElementById('preview_input_file_schoolarship');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
