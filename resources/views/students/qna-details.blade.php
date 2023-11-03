<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12 mbottom-15 {{ Auth::user()->role == 'lecturer' ? 'd-none' : '' }}">
                <div class="side-menu-log">
                    <button class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15" id="to_create_qna">Tulis
                        Pertanyaan</button>
                </div> 
            </div>
            <div class="col-lg-{{ Auth::user()->role == 'lecturer' ? '12' : '9' }} col-sm-12">
                <div class="main-menu-log shadow-mobile">
                    <div class="table-responsive">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                            <span class="fw-600 fp-white">Tanya Jawab</span>
                        </div>
                        <div class="rounded-sm-top top-table-log border-bottom-none">
                            <h5 class="fp-black">Detail Pertanyaan</h5>
                        </div>
                        <div class="border-primary-grey rounded-sm-bottom p-25">
                            {{-- <div class="rounded-sm-bottom content-table-article flex-center m-auto">
                                <h5 class="fp-black m-auto fw-400">Belum Ada Tanya Jawab</h5>
                            </div> --}}
                            {{-- @foreach ($question as $item) --}}
                            <div class="col-lg-12">
                                <div class="fp-grey-secondary fw-700 fs-12 mbottom-10">
                                    {{ $data->created_at->format('d F Y') }}</div>
                                <p class="text-ellipsis-2 mtop-10 mbottom-10 fw-400 fp-black">{{ $data->question }}</p>
                                <div class="bg-primary-grey rounded-sm p-15">
                                    @if (count($data->answer) > 0)
                                        @foreach ($data->answer as $item)
                                            <div class="mbottom-10">
                                                <div class="flex-center">
                                                    <div class="fp-black fw-400 fs-10 mtop-5 mbottom-5 mright-5">{{ $item->reply_by == 'lecturer' ? 'Dosen' : 'Mahasiswa' }}
                                                    </div>
                                                    <div class="fp-grey-secondary fw-400 fs-10 mtop-5 mbottom-5 mright-5">{{ $item->created_at->format('d F Y') }}</div>
                                                </div>
                                                <div class="flex-center">
                                                    <img width="11" class="mright-5"
                                                        src="{{ asset('/guestAssets/img/grey_arrow_right.svg') }}"
                                                        alt="">
                                                    <div class="fp-black fw-600">{{ $item->answer }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="mbottom-10">
                                            <div class="flex-center">
                                                <div class="fp-black fw-400">Belum ada jawaban!</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <form action="" id="create_reply_form" class="w-100">
                                    <div class=" col-lg-12 d-flex mtop-10">
                                        @csrf
                                        <input type="hidden" name="question_id" id="question_id" value="{{ $data->id }}">
                                        <input placeholder="ketik jawaban anda" type="text" class="col-lg-10 col-sm-8 input-grey mright-10" name="reply" id="reply">
                                        <button type="submit" class="col-lg-2 col-sm-4 btn-rounded-sm primary">submit</button>
                                    </div>
                                </form>
                            </div>
                            {{-- @endforeach --}}
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
