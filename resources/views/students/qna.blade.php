<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100">
            <div class="col-lg-3 col-sm-12 mbottom-15 {{ Auth::user()->role == 'lecturer' ? 'd-none' : '' }}">
                <div class="side-menu-log">
                    <button class="flex-center btn-add pointer fw-700 rounded-sm mbottom-15" id="to_create_qna">Tulis Pertanyaan</button>
                </div>
            </div>
            <div class="col-lg-{{ Auth::user()->role == 'lecturer' ? '12' : '9' }} col-sm-12">
                <div class="main-menu-log -mobile">
                    <div class="table-responsive w-100-mobile">
                        <div class="bg-primary-black rounded-sm pt-20 pb-20 pl-35 mbottom-15">
                            <span class="fw-600 fp-white">Tanya Jawab</span>
                        </div>
                        <div class="flex-center-between rounded-sm-top top-table-log border-bottom-none fixed-flex">
                            <h5 class="fp-black">Daftar Pertanyaan</h5>
                            <div class="flex-center">
                                <h5 class="fp-black mright-5">Urutkan</h5>
                                <div class="select-custom" data-id="sort_by">
                                    <div class="option-item selected">
                                        <select id="qna_filter" name="qna_filter" class="selection">
                                            <option value="" selected disabled> --Pilih Filter--</option>
                                            <option value="newest"> Terbaru</option>
                                            <option value="oldest"> Paling Lama</option>
                                            {{-- <option value=""> Sesama Topik</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-primary-grey rounded-sm-bottom p-25">
                            @if (count($question) > 0)
                                @foreach ($question as $item)
                                    <a href="{{ asset('/qna-details/'.$item->code)}}" class="decoration-none">
                                        <div class="bg-primary-grey pointer rounded-sm p-15 d-flex align-start mbottom-15">
                                            <img class="dots-yelllow" src="{{ asset('guestAssets/img/dots-yellow.svg') }}" alt="">
                                            <div class="col-lg-11">
                                                <div class="fp-grey-secondary fw-700 mbottom-10">{{ $item->created_at->format('d F Y') }}</div>
                                                <p class="text-ellipsis-2 mbottom-10 fw-400 fp-black">{{ $item->question }}</p>
                                                <div class="bg-primary-grey rounded-sm fp-blue fw-700 fs-12 fw-400">Lihat Jawaban</div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="rounded-sm-bottom content-table-article flex-center m-auto">
                                    <h5 class="fp-black m-auto fw-400">Belum Ada Tanya Jawab</h5>
                                </div>
                            @endif
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

