@extends('layouts.app')

@section('content')
  <div class="header bg-primary pb-6">
      <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboards</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                      </ol>
                    </nav>
                </div>
            </div>
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                  <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total User Aktif</h5>
                                    <br>
                                    <span class="h2 font-weight-bold mb-0">{{ $data_account }}</span>
                                  </div>
                                  <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                      <i class="ni ni-single-02"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                  <h5 class="card-title text-uppercase text-muted mb-0">Total <br>Service</h5>
                                  <br>
                                  <span class="h2 font-weight-bold mb-0">{{ $total_service }}</span>
                                </div>
                                <div class="col-auto">
                                  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                    <i class="ni ni-chart-pie-35"></i>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                          <div class="row">
                              <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Service Selesai</h5>
                                <br>
                                <span class="h2 font-weight-bold mb-0">{{ $service_selesai }}</span>
                              </div>
                              <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                  <i class="ni ni-check-bold"></i>
                                </div>
                              </div>
                          </div>
                          {{-- <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                            <span class="text-nowrap">Since last month</span>
                          </p> --}}
                      </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                        <div class="card-body">
                          <div class="row">
                              <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Service di Tolak</h5>
                                <br>
                                <span class="h2 font-weight-bold mb-0">{{ $service_reject }}</span>
                              </div>
                              <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                  <i class="ni ni-fat-remove"></i>
                                </div>
                              </div>
                          </div>
                          {{-- <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                            <span class="text-nowrap">Since last month</span>
                          </p> --}}
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
  <footer class="footer pt-0 mt-4">
    <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
                &copy; 2022 <a  href="https://www.keluarga-kita.com/" class="font-weight-bold ml-1"
                    target="_blank">Rumah Sakit Keluarga Kita - Developer Alfin Nurhidayat</a>
            </div>
        </div>
    </div>


@endsection
