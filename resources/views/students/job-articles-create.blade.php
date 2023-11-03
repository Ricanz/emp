<x-guest-layout>
    <div class="container">
        <div class="row mbottom-100">
            <div class="col-lg-12">
                <div class="main-menu-log">
                    <div class="table-responsive">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-30">
                            <span class="fw-600 fp-white">{{$title}}</span>
                        </div>
                        <div class="report-table">
                            <div class="border-primary-grey rounded-sm-bottom p-25">
                                <div class="article-item">
                                    <form id="create_article_form">
                                        @csrf
                                        <div class="col-lg-12 flex-column">
                                            <h5 class="mbottom-50">Posting Artikel</h5>
                                            <div class="row align-center mbottom-15">
                                                <div class="col-lg-3">
                                                    <h5>Judul Postingan</h5>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input class="input-grey" type="text" name="title">
                                                    <input class="input-grey" type="hidden" name="type" value="{{ request()->get('type') }}">
                                                </div>
                                            </div>
                                            <div class="row mbottom-15" style="margin-bottom: 40px !important">
                                                <div class="col-lg-3">
                                                    <h5>Konten</h5>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div id="editor" style="min-height:200px;background-color: #F8F8F8;"></div>
                                                </div>
                                            </div>
                                            <div class="row mbottom-15">
                                                <div class="col-lg-3">
                                                    <h5>Banner Beasiswa</h5>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input id="input_file_job_articles" accept="image/png, image/gif, image/jpeg , image/webp"  style="display:none;" class="input-file" name="image" type="file" onchange="loadFile2(event)" />
                                                    <div class="upload-file">
                                                        <h5 class="fw-700 fp-blue text-right pointer" onclick="$('#input_file_job_articles').click()">Upload Banner</h5>
                                                        <div class="image-container">
                                                            <img id="preview_input_file_job_articles" class="w-40 image-uploaded" src="{{ asset('guestAssets/img/dummy-image.svg') }}" alt="your image" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn-rounded-lg mleft-auto">Posting</button>
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
        <script src="{{url('/custom/guest/job-articles.js')}}" type="application/javascript" ></script>
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
</script>

<style>

    #editor{
        border: 1px solid #E5E5E5
    }
</style>