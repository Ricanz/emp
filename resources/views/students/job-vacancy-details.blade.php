<x-guest-layout>
    <div class="container">
        <div class="row flex-wrap mbottom-100 ">
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
                                @foreach($locations as $item)
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
                            <div class="rounded-sm-top top-table-log border-bottom-none">
                                <h5 class="fp-black">Lowongan Kerja Terbaru - Semua Kategori</h5>
                            </div>
                            <div class="border-primary-grey rounded-sm-bottom p-25">
                                <div class="article-item details-job d-flex align-start">
                                    <div class="col-lg-9 col-sm-12 flex-column">
                                        <div class="banner-details-job mbottom-10">
                                            <img src="{{ $job->image != null ? asset($job->image) : asset('/guestAssets/img/dummy-logo.svg') }}" alt="">
                                        </div>
                                        <h5 class="mbottom-5">{{ $job->title }}</h5>
                                        <h5 class="fw-400 mbottom-15">PT Cashtree for Indonesia - {{ $job->locat->location }}</h5>
                                        <div class="mbottom-15">
                                            <h5 class="mbottom-5">Deskripsi pekerjaan</h5>
                                            {!! $job->description !!}
                                        </div>
                                        {{-- <h5 class="fw-400 mbottom-20">Rp 4.500.000 - Rp 6.000.000</h5>
                                        <div class="mbottom-15">
                                            <h5>Benefit</h5>
                                            <ul>
                                                <li>Jenjang Karir</li>
                                                <li>Exploring New Experience</li>
                                                <li>Lingkungan Kerja yang dinamis</li>
                                            </ul>
                                        </div> --}}
                                        {{-- <div class="mbottom-15">
                                            <h5>Deskripsi pekerjaan</h5>
                                            <ul class="mbottom-15">
                                                <li>Pendidikan S1 Psikologi, SDM, Sederajat</li>
                                                <li>Pengalaman minimal 1 tahun sebagai rekrutmen</li>
                                                <li>Memahami berbagai Job Portal, Virtual Jobfair / Campus Hiring</li>
                                                <li>Familiar dan dapat menggunakan alat ukur kepribadian</li>
                                                <li>Dapat melakukan test secara Klasikal dan Individual</li>
                                                <li>Tertib administrasi</li>
                                                <li>Bersedia melakukan dinas luar kota bila dibutuhkan</li>
                                                <li>Membantu HR Supervisor dalam pengelolaan data dan report SDM</li>
                                                <li>Harap cantumkan domisili saat ini pada bagian deskripsi</li>
                                                <li>Kandidat terpilih akan dihubungi kembali untuk seleksi awal</li>
                                            </ul>
                                        </div> --}}
                                        <h5>Tanggal Posting</h5>
                                        <h5 class="fw-400">{{ $job->created_at->format('d M Y') }}</h5>
                                    </div>
                                    {{-- <div class="col-lg-3">
                                        <button class="btn-rounded btn-apply --yet-applied"></button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{url('/custom/guest/job-vacancy.js')}}" type="application/javascript" ></script>
    @endsection
</x-guest-layout>