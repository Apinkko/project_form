@extends('layouts.app')

@section('content')
<!-- Main content -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('request_service') }}">Request Service</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tables</li>
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
              @include('components.alert')
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0 text-dark">Permohonan Service</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-data" style="width: 100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>No.Tiket</th>
                          <th>Nama Pemohon</th>
                          <th>department</th>
                          <th>Jabatan</th>
                          <th>Perbaikan</th>
                          <th>Tgl.Permohonan</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($service_requests  as $service_request)
                        @if($service_request->type_permohonan == 1 && $service_request->status_id < 8)
                          <tr class="text-danger">
                        @else
                          <tr>
                        @endif
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $service_request->no_tiket }}</td>
                          <td>{{ $service_request->user->nama }}</td>
                          <td>{{ $service_request->user->department->department}}</td>
                          <td>{{ $service_request->user->jabatan->jabatan}}</td>
                          <td>{{ $service_request->service }}</td>
                          <td>{{ $service_request->created_at->format('d-M-Y h:i:'). ' WIB' }}</td>
                          <td>
                            @if ($service_request->status_id == 5)
                              <span class="badge badge-warning">{{ $service_request->status->status }}</span>
                            @elseif ($service_request->status_id == 6)
                              <span class="badge badge-info">{{ $service_request->status->status }}</span>
                            @elseif($service_request->status_id == 7)
                              <span class="badge badge-success">{{ $service_request->status->status }}</span>
                            @elseif($service_request->status_id == 8)
                              <span class="badge badge-secondary">{{ $service_request->status->status }}</span>
                            @elseif($service_request->status_id == 9)
                              <span class="badge badge-danger">{{ $service_request->status->status }}</span>
                            @endif
                          </td>
                          <td class="d-flex">
                            <a href="{{ route('service.show', $service_request->id) }}" class="btn btn-sm btn-secondary" title="Lihat Service"><i class="fa fa-eye"></i></a>
                            @if($service_request->status_id == 5 && Auth::user()->department_id == 7)
                              <a type="button" href="{{ url('approve/service', $service_request->id) }}" class="btn btn-success btn-sm text-light" title="approved service" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-check"></i></a>
                              <div class="aksi d-inline" id="aksi">
                              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" title="Tolak Permohonan Service" data-target="#rejected{{ $service_request->id }}"><i class="fas fa-times"></i></button>

                              <!-- Modal Ditolak-->
                              <div class="modal fade" id="rejected{{ $service_request->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                      <div class="modal-header text-center">
                                        <h5 class="modal-title" id="exampleModalLabel">Alasan Ditolak</h5>
                                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                          <form action="{{ url('reject/service') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{ $service_request->id }}" readonly>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="">Alasan Penolakan</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea type="text" name="keterangan" class="form-control" cols="5" rows="5" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"  onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')">Tolak Service</button>
                                            </div>
                                          </form>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            @elseif ($service_request->status_id == 6 && Auth::user()->department_id != 7)
                              {{-- REVISI 18 MEI 2022--}}
                                @if(Auth::user()->department_id == 4 && Auth::user()->jabatan_id == 2)
                                      <div class="aksi d-inline" id="aksi">
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#approved{{ $service_request->id }}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <br>
                                        <!-- Modal konfimasi service -->
                                        <div class="modal fade" id="approved{{ $service_request->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                  <form action="{{ url('request_service/onprogress') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="service_id" value="{{ $service_request->id }}" readonly>
                                                    <div class="form-group">
                                                      <div class="col-md-12">
                                                          <label for="exampleFormControlInput1">Pilih Teknisi</label>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <select name="teknisi_umum_id" id="teknisi_umum_id" class="form-control" required>
                                                                  <option value="" disabled {{ is_null(old('teknisi_umum_id')) ? 'selected' : '' }} >-Pilih-</option>
                                                              @foreach ($teknisi_umums as $teknisi_umum)
                                                                  <option value="{{ $teknisi_umum->id }}">{{ $teknisi_umum->nama_teknisi_umum }}</option>
                                                              @endforeach
                                                          </select>
                                                      </div>
                                                    </div>
                                                    <div class="form-group">
                                                      <div class="col-md-6">
                                                          <label for="">Perkiraan Biaya</label>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <input type="text" id="biaya_service" name="biaya_service" class="form-control">
                                                      </div>
                                                   </div>
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <label for="">Keterangan</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <textarea type="text" name="keterangan" class="form-control" cols="5" rows="5" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')">Service Completed</button>
                                                    </div>
                                                  </form>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  @else
                                    <a href="{{ url('request_service/onprogress', $service_request->id) }}" class="btn btn-sm btn-success" title="On Progress Service" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-check"></i></a>
                                @endif
                              {{-- END REVISI 18 MEI 2022 --}}

                              {{-- MODAL TOLAK --}}
                              <div class="aksi d-inline d-flex" id="aksi" width="70%">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#closed{{ $service_request->id }}">
                                  <i class="fa fa-times"></i>
                                </button>
                                  <br>
                                <!-- Modal Closed-->
                                <div class="modal fade" id="closed{{ $service_request->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title" id="exampleModalLabel">Keterangan Service diTolak</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="{{ url('request_service/closed') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{ $service_request->id }}" readonly>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="">Keterangan</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea type="text" name="keterangan" class="form-control" cols="5" rows="5" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')">Service Completed</button>
                                            </div>
                                          </form>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @elseif ($service_request->status_id == 7)
                              <div class="aksi d-inline" id="aksi">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#approved{{ $service_request->id }}">
                                    <i class="fa fa-check"></i>
                                </button>
                                <br>
                                <!-- Modal Selesai -->
                                <div class="modal fade" id="approved{{ $service_request->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title" id="exampleModalLabel">Keterangan Service Selesai</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="{{ url('request_service/selesai') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{ $service_request->id }}" readonly>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="">Keterangan</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea type="text" name="keterangan" class="form-control" cols="5" rows="5" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')">Service Completed</button>
                                            </div>
                                          </form>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center  text-lg-left  text-muted">
                    &copy; 2022 <a  href="https://keluarga-kita.com" class="font-weight-bold ml-1"
                        target="_blank">Rumah Sakit Keluarga Kita - Developer Alfin Nurhidayat</a>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    console.log("Ready!");

    $('#jenis_inventoris').change(function(){
    //   $('#inventaris').empty();
     var jenisinventaris = $(this).children("option:selected").val();
      $.ajax({
          async: false,
          type:'post',
          url:'{{url('/get_inventaris/service')}}',
          data:{ _token : '{{ csrf_token() }}',
                id_jenis : jenisinventaris}
          ,success:function(response){
          respon = $.parseJSON(response);
              if(respon.response == 'success')
              {
                var data = respon.val_inventaris;
                var tot_data = data.length;
                var select = "<select name='inventaris_id' id='inventaris' class='form-control' required>"
                              +"<option>-Pilih-</option>";
                  if(tot_data != 0){
                    for(a=0; a<tot_data; a++)
                    {
                          var id = data[a].id;
                          var inventaris = data[a].nama;
                          var no_inventaris = data[a].no_inventaris;
                          select = select + "<option value="+id+">"+inventaris+" - "+no_inventaris+"</option>";

                    };
                    select = select + "</select>";
                    $('#div_inventaris').empty().append(select);
                  }
              }else{
                  console.log('Data Tidak Tersedia');
                  alert('Data Tidak Tersedia');
              }
          },
      });
    });
  });
  </script>
@endsection
