<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12">
                <div class="side-menu-log">
                    <div class="rounded-sm border-primary-grey pt-30 pb-30 pr-20 pl-20 mbottom-30">
                        <h5 class="fp-black text-center mbottom-20">Cari Lowongan</h5>
                        <form action="/job-vacancy">
                        <div class="search-component mbottom-15">
                            <img width="20" src="{{ asset('/guestAssets/img/search.svg') }}" alt="">
                            <input class="w-100" placeholder="Cari Lowongan" type="search" name="search">
                        </div>
                        <div class="select-custom --grey mbottom-20" data-id="item_location">
                            <select id="location" name="location" class="selection">
                                <option value="0"> Pilih Lokasi </option>
                                @foreach($location as $item)
                                    <option value="{{$item->id}}"> {{$item->location}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-custom --grey mbottom-20" data-id="item_location">
                            <select id="location" name="category" class="selection">
                                <option value="0"  >Semua Kategori </option>
                                <option value="5">Full Time</option>
                                <option value="7">Part Time</option>
                                <option value="6">Freelance</option>
                            </select>
                        </div>
                        <button class="btn-rounded-lg primary w-100">Cari</button>
                    </form>
                    </div>
                    @if(Auth::user()->role == 'alumni')
                        <button class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15" id="post_job">Posting Lowongan</button>
                    @endif
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="main-menu-log">
                    <div class="table-responsive">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                            <span class="fw-600 fp-white">Lowongan Kerja</span>
                        </div>
                        <div class="report-table">
                            <div class="border-primary-grey rounded-sm-bottom p-25">
                                <div class="article-item">
                                    <form id="create_job_form">
                                        @csrf
                                        <div class="col-lg-12 flex-column">
                                            <h5 class="mbottom-25">Posting Lowongan</h5>
                                            <div class="row flex-wrap align-center mbottom-15">
                                                <div class="col-lg-3 col-sm-12 mbottom-10-mobile">
                                                    <h5>Judul Lowongan</h5>
                                                </div>
                                                <div class="col-lg-9 col-sm-12">
                                                    <input class="input-grey" type="text" name="title">
                                                </div>
                                            </div>
                                            <div class="row flex-wrap align-center mbottom-15">
                                                <div class="col-lg-3 col-sm-12 mbottom-10-mobile">
                                                    <h5>Nama Perusahaan</h5>
                                                </div>
                                                <div class="col-lg-9 col-sm-12">
                                                    <input class="input-grey" type="text" name="company">
                                                </div>
                                            </div>
                                            <div class="row flex-wrap mbottom-15">
                                                <div class="col-lg-3 col-sm-12 mbottom-10-mobile">
                                                    <h5>Provinsi</h5>
                                                </div>
                                                {{-- <div class="col-lg-9 col-sm-12">
                                                    <input class="input-grey" type="text" name="province">
                                                </div> --}}

                                                <div class="select-custom --grey mbottom-20 col-lg-9 col-sm-12" data-id="item_location">
                                                    <select id="location" name="location" class="selection">
                                                        <option value="0"> Pilih Lokasi </option>
                                                        @foreach($location as $item)
                                                            <option value="{{$item->id}}"> {{$item->location}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row flex-wrap mbottom-15">
                                                <div class="col-lg-3 col-sm-12 mbottom-10-mobile">
                                                    <h5>Foto Perusahaan</h5>
                                                </div>
                                                <div class="col-lg-9 col-sm-12">
                                                    <div class="upload-file none-mtop">
                                                        <h5 class="fw-700 fp-blue pointer">Upload Gambar Perusahaan</h5>
                                                        <input id="file_job_articles" class="input-file h-100" name="image" type="file" multiple onchange="loadFile2(event)" />
                                                        <img id="preview_input_file_job_articles" class="container-img-preview flex-center image-uploaded w-40 rounded-md" src="{{ asset('guestAssets/img/dummy-image.svg') }}" alt="your image" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row flex-wrap mbottom-15">
                                                <div class="col-lg-3 col-sm-12 mbottom-10-mobile">
                                                    <h5>Kategori Pekerjaan</h5>
                                                </div>
                                                <div class="select-custom --grey mbottom-20 col-lg-9 col-sm-12" data-id="item_location">
                                                    <select id="location" name="category" class="selection">
                                                        <option value="0"> Pilih Kategori </option>
                                                        <option value="fulltime">Full Time</option>
                                                        <option value="parttime">Part Time</option>
                                                        <option value="freelance">Freelance</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mbottom-15" style="margin-bottom: 40px !important">
                                                <div class="col-lg-3">
                                                    <h5>Deskripsi Pekerjaan</h5>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div id="editor" style="min-height:200px;background-color: #F8F8F8;"></div>
                                                </div>
                                            </div>
                                            <br/>

                                            {{-- <div class="row flex-wrap mbottom-15">
                                                <div class="col-lg-3 col-sm-12">
                                                    <h5>Deskripsi Pekerjaan</h5>
                                                </div>
                                                <div class="col-lg-9 col-sm-12">
                                                    <div id="editor"></div>
                                                </div>
                                            </div> --}}
                                            <div class="row flex-wrap mbottom-65">
                                                <div class="col-lg-3 col-sm-12 mbottom-10-mobile">
                                                    <h5>End Date</h5>
                                                </div>
                                                <div class="col-lg-9 col-sm-12">
                                                    <input type="date" class="input-grey" name="end_date">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn-rounded-lg primary mleft-auto">Posting</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="{{url('/custom/guest/job-vacancy.js')}}" type="application/javascript" ></script>
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
        var output = document.getElementById('preview_input_file_job_articles');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
