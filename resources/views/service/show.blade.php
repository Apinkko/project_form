@extends('layouts.app')


@section('content')
{{-- @dd($service) --}}
<!-- Main content -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('service') }}">Service</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0 text-dark">Detail Service</h3>
                </div>
                @if($service->type_permohonan == 1)
                  <h3 class="text-danger text-center"><i class="fas fa-exclamation-triangle"></i> URGENT</h3>
                @endif
                <!-- Light table -->
                <div class="p-4">
                  <div class="mb-3">
                    <label for="department" class="form-label">Dari Departemen</label>
                    <input type="text" class="form-control" id="department" placeholder="" value="{{ $service->user->department->department }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Permohonan Service</label>
                    <input type="text" class="form-control" id="tanggal" placeholder="" value="{{ $service->created_at->format('D, d M Y') }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="inventaris" class="form-label">Jenis Inventaris</label>
                    <input type="text" class="form-control" id="inventaris" placeholder="" value="{{ $service->inventaris->jenis_inventaris->jenis_inventaris }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="inventaris" class="form-label">Inventaris</label>
                    <input type="text" class="form-control" id="inventaris" placeholder="" value="{{ $service->inventaris->nama }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="service" class="form-label">Service/Perbaikan</label>
                    <input type="text" class="form-control" id="service" placeholder="" value="{{ $service->service }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="biaya_service" class="form-label">Perkiraan Biaya</label>
                    <input type="text" class="form-control" id="biaya_service" placeholder="" value="@currency($service->biaya_service)" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Service</label>
                    <textarea name="" id="keterangan" cols="30" rows="5" class="form-control" readonly> {{ $service->keterangan }}</textarea>
                  </div>
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Status</label>
                    @if ($service->status_id == 3 || $service->status_id == 4)
                      <td><span class="badge badge-info">{{ $service->status->status }}</span></td>
                    @elseif($service->status_id == 5)
                      <td><span class="badge badge-warning">{{ $service->status->status }}</span></td>
                    @elseif($service->status_id == 6 || $service->status_id == 7)
                      <td><span class="badge badge-success">{{ $service->status->status }}</span></td>
                    @elseif($service->status_id == 8)
                      <td><span class="badge badge-secondary">{{ $service->status->status }}</span></td>
                    @elseif($service->status_id == 9 || $service->status_id == 10)
                      <td><span class="badge badge-danger">{{ $service->status->status }}</span></td>
                    @endif
                  </div>
                  @if($service->teknisi_id != null)
                    <div class="mb-3">
                      <label for="teknisi_id" class="form-label" style="font-weight: 700;"><i class="fa fa-user mr-1" style="color: #15B771;"></i>Teknisi : </label>
                      <span class="text-primary font-weight-bold" readonly> {{ $service->teknisi->nama }}</span>
                      {{-- <input name="" id="teknisi_id" class="form-control" value="{{ $service->teknisi->nama }}" readonly> --}}
                    </div>
                  @elseif($service->teknisi_umum_id != null)
                    <div class="mb-3">
                      <label for="teknisi_id" class="form-label" style="font-weight: 700;"><i class="fa fa-user mr-1" style="color: #15B771;"></i>Teknisi : </label>
                      <span class="text-primary font-weight-bold" readonly> {{ $service->teknisi_umum->nama_teknisi_umum }}</span>
                      {{-- <input name="" id="teknisi_id" class="form-control" value="{{ $service->teknisi->nama }}" readonly> --}}
                    </div>
                  @endif
                  @if(count($keterangan_service) != 0)
                    <div class="container-fluid">
                      <div class="row justify-start">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                      <tr>
                                        <th class="text-left">User</td>
                                        <th class="text-center">Keterangan</td>
                                        <th class="text-right">Tgl. Keterangan</td>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($keterangan_service as $val)
                                      <tr>
                                        <td class="text-left">{{ $val->user->nama }}</td>
                                        <td class="text-center">{{ $val->keterangan }}</td>
                                        <td class="text-right">{{ $val->created_at->format('D, d M Y') }}</td>
                                      </tr>
                                     @endforeach
                                  </tbody>

                              </table>
                            </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                  <button class="btn btn-lg btn-secondary" onclick="history.back()">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center  text-lg-left  text-muted">
                    &copy; 2022 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Rumah Sakit Keluarga Kita</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection
