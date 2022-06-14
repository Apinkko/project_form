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
                            <li class="breadcrumb-item"><a href="#">Service</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tables</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5">
                    <!-- <a href="#" class="btn btn-sm btn-neutral">Tambah Data</a> -->
                    <!-- Button trigger modal -->
                    <div class="button-right">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#tambah">
                            Tambah data
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Form Service</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('service.store') }}" method="post">
                                        @csrf
                                       <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="exampleFormControlInput1">Jenis Service</label>
                                            </div>
                                            <div class="col-md-12">
                                                <select name="jenis_inventaris_id" id="jenis_inventoris" class="form-control" required>
                                                        <option value="" disabled {{ is_null(old('jenis_inventori_id')) ? 'selected' : '' }} >-Pilih-</option>
                                                    @foreach ($jenis_inventariss as $jenis_inventaris)
                                                        <option value="{{ $jenis_inventaris->id }}">{{ $jenis_inventaris->jenis_inventaris }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="col-md-12">
                                              <label for="exampleFormControlInput1">Inventaris</label>
                                            </div>
                                          <div class="col-md-12" id="div_inventaris">
                                              <select name="inventaris" id="inventaris" class="js-example-basic-single" required>
                                                  <option value="">- Silahkan Pilih -</option>
                                              </select>
                                              <small id="small" class='text-primary'></small>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1">Service/Perbaikan</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea name="service" id="service" class="form-control" cols="30" rows="6" required></textarea>
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
                                                <label for="exampleFormControlInput1">Keterangan</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="6"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')">Save</button>
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
                @if (Auth::user()->jabatan_id == 3)
                <a href="{{ url('export/excel_service') }}" class="btn btn-success mb-3">Export Excel</a>
                @endif
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-data" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No.Tiket</th>
                        <th>Nama Pemohon</th>
                        <th>department</th>
                        @if (Auth::user()->jabatan_id == 1)
                         <th>Unit</th>
                        @endif
                        <th>Tgl.Permohonan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($services  as $service)
                      @if($service->type_permohonan != 0 && $service->status_id <= 7)
                        <tr class="text-danger">
                      @else
                        <tr>
                      @endif
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->no_tiket }}</td>
                        <td>{{ $service->user->nama }}</td>
                        <td>{{ $service->user->department->department}}</td>
                        @if (Auth::user()->jabatan_id == 1)
                          <td>{{ $service->user->unit->nama_unit}}</td>
                        @endif
                        <td>{{ $service->created_at->format('d, M Y H:i'). " WIB" }}</td>
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
                        <td>
                            <div class="aksi" id="aksi">
                              <a href="{{ route('service.show', $service->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>

                              @if (Auth::user()->jabatan_id == 2 || Auth::user()->jabatan_id == 3 || Auth::user()->jabatan_id == 4)
                                @if($service->status_id == 3 || $service->status_id == 4)
                                  {{-- @if(Auth::user()->jabatan_id == 2)
                                    @if($service->status_id == 3)
                                      <a type="button" href="{{ url('approve/service', $service->id) }}" class="btn btn-success btn-sm text-light" title="approved service" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-check"></i></a>
                                      <div class="aksi d-inline" id="aksi">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" title="Tolak Permohonan Service" data-target="#rejected{{ $service->id }}"><i class="fas fa-times"></i></button>
                                      </div>
                                      <!-- Modal Ditolak-->
                                      <div class="modal fade" id="rejected{{ $service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <input type="hidden" name="service_id" value="{{ $service->id }}" readonly>
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
                                    @endif --}}
                                  @if(Auth::user()->jabatan_id == 2 || Auth::user()->jabatan_id == 3 || Auth::user()->jabatan_id == 4)
                                      @if (Auth::user()->department_id == 4)
                                         <div class="aksi d-inline" id="aksi" style="display: none !important;">
                                      @endif
                                      <div class="aksi d-inline" id="aksi">
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" title="Approve Permohonan Service" data-target="#approved{{ $service->id }}"><i class="fas fa-check"></i></button>
                                      </div>
                                      <!-- Modal AProve-->
                                      <div class="modal fade" id="approved{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                          <div class="modal-content">
                                            <div class="modal-header text-center">
                                              <h5 class="modal-title" id="exampleModalLabel">Urgently Service</h5>
                                              <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('approve_manager/service') }}" method="GET">
                                                  @csrf
                                                  <input type="hidden" name="service_id" value="{{ $service->id }}" readonly>
                                                  <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="exampleFormControlInput1">Urgently</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="radio" name="type_permohonan" value="0" required>Not Urgent
                                                        <input type="radio" name="type_permohonan" value="1" required>Urgent
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <div class="col-md-6">
                                                          <label for="">Keterangan Urgent</label>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <textarea type="text" name="keterangan" class="form-control" cols="5" rows="5" required></textarea>
                                                      </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-primary"  onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')">Approve Service</button>
                                                  </div>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      @if (Auth::user()->department_id == 4)
                                        <div class="aksi d-inline" id="aksi" style="display: none !important;">
                                      @endif
                                      <div class="aksi d-inline" id="aksi">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" title="Tolak Permohonan Service" data-target="#rejected{{ $service->id }}"><i class="fas fa-times"></i></button>
                                      </div>
                                        <!-- Modal Ditolak-->
                                        <div class="modal fade" id="rejected{{ $service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                      <input type="hidden" name="service_id" value="{{ $service->id }}" readonly>
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
                                  @endif
                                @endif
                                @else
                                  @if($service->status_id == 3)
                                    <form action="{{ route('service.destroy', $service->id) }}" method="POST" class="d-inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" title="Cancel Permohonan" onclick="return confirm('Apakah Anda Ingin Membatalkan Data ini?')"><i class="fas fa-times"></i></button>
                                    </form>
                                  @endif
                              @endif
                            </div>
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
                &copy; 2022 <a  href="https://www.keluarga-kita.com/" class="font-weight-bold ml-1"
                    target="_blank">Rumah Sakit Keluarga Kita - Developer Alfin Nurhidayat</a>
            </div>
        </div>
    </div>
  </footer>
</div>

<script src="{{ url('https://code.jquery.com/jquery-1.9.1.min.js') }}"></script>
<script src="{{ url('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    console.log('Ready !');
    // $('#inventaris').select2();
    $("#inventaris").select2({
      theme: "classic"
    });

    $('#jenis_inventoris').change(function(){
      $('#inventaris').empty();
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
                // var select = "<select name='inventaris_id' id='inventaris' class='form-control' onfocus='this.size=5;'"
                //               +"onchange='this.size=5; this.blur();' onfocusout='this.size=null;' required>"
                //               +"<option>-Pilih-</option>";
                // var select = "<select name='inventaris_id' id='inventaris' class='form-control' required>"
                //               +"<option>-Pilih-</option>";
                var select = "<option>- Silahkan Pilih -</option>";
                  if(tot_data != 0){
                    for(a=0; a<tot_data; a++)
                    {
                          var id = data[a].id;
                          var inventaris = data[a].nama;
                          var no_inventaris = data[a].no_inventaris;
                          // select = select + "<option value="+id+">"+inventaris+" - "+no_inventaris+"</option>";
                          if(no_inventaris == null ){
                            select = select + "<option value="+id+">"+inventaris+"</option>";
                          } else {
                            select = select + "<option value="+id+">"+inventaris+" - "+no_inventaris+"</option>";
                          }

                    };
                    select = select + "</select>";
                    small =  "<small id='small' class='text-primary'>* Bila pilihan Inventaris tidak tersedia silahkah piilih option <strong>Lainnya</strong></small>";
                    // $('#div_inventaris').empty().append(select);
                    $('#inventaris').empty().append(select);
                    $('#small').empty().append(small);
                  }
              }else{
                  console.log('Data Tidak Tersedia');
                  alert('Data Tidak Tersedia');
              }
          },
      });
    });
  })

  // form input di Biaya Service
      var perkiraan_biaya = document.getElementById("biaya_service");
      perkiraan_biaya.addEventListener("keyup", function(e) {
         perkiraan_biaya.value = convertRupiah(this.value, "Rp. ");
      });
      perkiraan_biaya.addEventListener('keydown', function(event) {
          return isNumberKey(event);
      });
  // form input di Edit Biaya Service
      // var edit_perkiraan_biaya = document.getElementById("edit_biaya_service");
      // edit_perkiraan_biaya.addEventListener("keyup", function(e) {
      //     edit_perkiraan_biaya.value = convertRupiah(this.value, "Rp. ");
      // });
      // edit_perkiraan_biaya.addEventListener('keydown', function(event) {
      //     return isNumberKey(event);
      // });
  // FUNCTION UNTUK CONVERT KE RUPIAH DI KEYUP
      function convertRupiah(angka, prefix) {
          var number_string = angka.replace(/[^,\d]/g, "").toString(),
          split  = number_string.split(","),
          sisa   = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

          if (ribuan) {
              separator = sisa ? "." : "";
              rupiah += separator + ribuan.join(".");
          }
          rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
          return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
      }
  // FUNCTION UNTUK NUMBER KEY DI KEYDOWN
      function isNumberKey(evt) {
          key = evt.which || evt.keyCode;
          if (key != 188 // Comma
              && key != 8 // Backspace
              && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
              && (key < 48 || key > 57) // Non digit
          ){
              evt.preventDefault();
              return;
          }
      }
  </script>
@endsection
