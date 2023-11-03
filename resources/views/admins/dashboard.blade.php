<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
          <div class="row">
            <div class="col-xl-5 ms-auto mt-xl-0 mt-4">
                <div class="row">
                  <div class="col-12">
                    <div class="card bg-gradient-primary">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8 my-auto">
                            <div class="numbers">
                              <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">Today</p>
                              <h5 class="text-white font-weight-bolder mb-0" >
                                  {{Carbon\Carbon::now()->translatedFormat('l')}} <span id="clock" onload="currentTime()">00:00:00 </span> 
                              </h5>
                            </div>
                          </div>
                          {{-- <div class="col-4 text-end">
                            <h5 class="mb-0 text-white text-end me-1">Depok</h5>
                          </div> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body text-center">
                        <h1 class="text-gradient text-primary"><span id="status1" countto="{{$mitra}}">{{$mitra}}</span></h1>
                        <h6 class="mb-0 font-weight-bolder">Mitra</h6>
                        {{-- <p class="opacity-8 mb-0 text-sm">Temperature</p> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mt-md-0 mt-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h1 class="text-gradient text-primary"> <span id="status2" countto="{{$lecturer}}">{{$lecturer}}</span> 
                          {{-- <span class="text-lg ms-n1">%</span> --}}
                      </h1>
                        <h6 class="mb-0 font-weight-bolder">Dosen</h6>
                        {{-- <p class="opacity-8 mb-0 text-sm">Humidity</p> --}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body text-center">
                        <h1 class="text-gradient text-primary"><span id="status3" countto="{{$student}}">{{$student}}</span></h1>
                        <h6 class="mb-0 font-weight-bolder">Mahasiswa</h6>
                        {{-- <p class="opacity-8 mb-0 text-sm">Consumption</p> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mt-md-0 mt-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h1 class="text-gradient text-primary"><span id="status4" countto="{{$student}}">{{$student}}</span></h1>
                        <h6 class="mb-0 font-weight-bolder">Magang</h6>
                        {{-- <p class="opacity-8 mb-0 text-sm">Aktif Magang</p> --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-xl-7">
              <div class="card">
                <div class="card-header d-flex pb-0 p-3">
                  <h6 class="my-auto">Gallery</h6>
                  <div class="nav-wrapper position-relative ms-auto w-50">
                  </div>
                </div>
                <div class="card-body p-3 mt-2">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show position-relative active height-400 border-radius-lg" id="cam1" role="tabpanel" aria-labelledby="cam1" style="background-image: url('../../assets/img/bg-smart-home-1.jpg'); background-size:cover;">
                      <div class="position-absolute d-flex top-0 w-100">
                        <p class="text-white p-3 mb-0">17.05.2021 4:34PM</p>
                        <div class="ms-auto p-3">
                          <span class="badge badge-secondary">
                            <i class="fas fa-dot-circle text-danger"></i>
                            Recording</span>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade position-relative height-400 border-radius-lg" id="cam2" role="tabpanel" aria-labelledby="cam2" style="background-image: url('../../assets/img/bg-smart-home-2.jpg'); background-size:cover;">
                      <div class="position-absolute d-flex top-0 w-100">
                        <p class="text-white p-3 mb-0">17.05.2021 4:35PM</p>
                        <div class="ms-auto p-3">
                          <span class="badge badge-secondary">
                            <i class="fas fa-dot-circle text-danger"></i>
                            Recording</span>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade position-relative height-400 border-radius-lg" id="cam3" role="tabpanel" aria-labelledby="cam3" style="background-image: url('../../assets/img/home-decor-3.jpg'); background-size:cover;">
                      <div class="position-absolute d-flex top-0 w-100">
                        <p class="text-white p-3 mb-0">17.05.2021 4:57PM</p>
                        <div class="ms-auto p-3">
                          <span class="badge badge-secondary">
                            <i class="fas fa-dot-circle text-danger"></i>
                            Recording</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <div class="row mt-4">
            {{-- <div class="col-lg-6 ms-auto">
              <div class="card">
                <div class="card-header pb-0 p-3">
                  <div class="d-flex align-items-center">
                    <h6 class="mb-0">Consumption by room</h6>
                    <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="See the consumption per room">
                      <i class="fas fa-info"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-5 text-center">
                      <div class="chart">
                        <canvas id="chart-consumption" class="chart-canvas" height="197"></canvas>
                      </div>
                      <h4 class="font-weight-bold mt-n8">
                        <span>471.3</span>
                        <span class="d-block text-body text-sm">WATTS</span>
                      </h4>
                    </div>
                    <div class="col-7">
                      <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                          <tbody>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-0">
                                  <span class="badge bg-gradient-primary me-3"> </span>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Living Room</h6>
                                  </div>
                                </div>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> 15% </span>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-0">
                                  <span class="badge bg-gradient-secondary me-3"> </span>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Kitchen</h6>
                                  </div>
                                </div>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> 20% </span>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-0">
                                  <span class="badge bg-gradient-info me-3"> </span>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Attic</h6>
                                  </div>
                                </div>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> 13% </span>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-0">
                                  <span class="badge bg-gradient-success me-3"> </span>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Garage</h6>
                                  </div>
                                </div>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> 32% </span>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-0">
                                  <span class="badge bg-gradient-warning me-3"> </span>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Basement</h6>
                                  </div>
                                </div>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> 20% </span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
            {{-- <div class="col-lg-6 mt-lg-0 mt-4">
              <div class="row">
                <div class="col-sm-6">
                  <div class="card h-100">
                    <div class="card-body p-3">
                      <h6>Consumption per day</h6>
                      <div class="chart pt-3">
                        <canvas id="chart-cons-week" class="chart-canvas" height="170"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div> --}}
          </div>
          <footer class="footer pt-3  ">
            <div class="container-fluid">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                  <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                      document.write(new Date().getFullYear())
                    </script>,
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">M-Knows Consulting</a>
                  </div>
                </div>
                
              </div>
            </div>
          </footer>
        </div>
      </main>

    @section('scripts') 
        <script src="{{url('/custom/admin/dashboard.js')}}" type="application/javascript" ></script>
    @endsection
</x-app-layout>

<script>
function currentTime() {
    let date = new Date(); 
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    let session = "AM";

    if(hh === 0){
        hh = 12;
    }
    if(hh > 12){
        hh = hh - 12;
        session = "PM";
    }

    hh = (hh < 10) ? "0" + hh : hh;
    mm = (mm < 10) ? "0" + mm : mm;
    ss = (ss < 10) ? "0" + ss : ss;
        
    let time = hh + ":" + mm + ":" + ss + " " + session;

    document.getElementById("clock").innerText = time; 
    let t = setTimeout(function(){ currentTime() }, 1000);
}

    currentTime();

</script>