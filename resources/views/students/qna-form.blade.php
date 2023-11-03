<x-guest-layout>
    <div class="container">
        <div class="row mbottom-100">
            <div class="col-lg-12 main-menu-log">
                    <div class="table-responsive">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                            <span class="fw-600 fp-white">Tulis Pertanyaan</span>
                        </div>
                        <div class="create-post border-primary-grey rounded-sm p-25">
                            <form id="create_qna_form">
                                @csrf
                                <div class="row flex-wrap mbottom-15">
                                    <div class="col-lg-3 col-sm-12 no-gutter mbottom-10-mobile">
                                        <h5>Pertanyaan</h5>
                                    </div>
                                    <div class="col-lg-9 col-sm-12 no-gutter">
                                        <input class="input-grey" type="text" name="question">
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
        <script src="{{url('/custom/guest/qna.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>