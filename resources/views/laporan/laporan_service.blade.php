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
                            <li class="breadcrumb-item"><a href="#">Laporan Service</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5">
                    <!-- <a href="#" class="btn btn-sm btn-neutral">Tambah Data</a> -->
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
                    <h3 class="mb-0 text-dark">Laporan Service</h3>
                </div>
                <div class="card-body">
                  <div class="row form-group">
                      <div class="col-md-3">
                          <label for="">Dari Tanggal</label>
                          <input  id="start_date"type="date" class="form-control">
                      </div>
                      <div class="col-md-3">
                          <label for="">Sampai Tanggal</label>
                          <input id="end_date" type="date" class="form-control" min="2022-03-06">
                      </div>
                      <div class="col-md-2 pt-4">
                         <button class="btn btn-lg btn-primary" onclick="search_report();">Submit</button>
                      </div>
                    </div>
                  <div class="form-group row ml-1">
                    <button type="reset" class="btn btn-warning ml-1" id="btn-reset" style="display:none;" onclick="reset();"><i class="fas fa-reply"></i>Reset</button>
                    <form action="{{ url('laporan_service/search_excel') }}" method="get">
                      @csrf
                      <input id="excel_start_date" type="hidden" name="start_date" readonly>
                      <input id="excel_end_date" type="hidden" name="end_date" readonly>
                      <button type="submit" class="btn btn-success ml-1" id="btn-excel" style="display:none;" ><i class="fas fa-excel"></i>Export Excel</button>
                    </form>
                    <form action="{{ url('laporan_service/search_pdf') }}" method="get" target="blank_">
                      @csrf
                      <input id="pdf_start_date" type="hidden" name="start_date" readonly>
                      <input id="pdf_end_date" type="hidden" name="end_date" readonly>
                      <button type="submit" class="btn btn-danger ml-1" id="btn-pdf" style="display:none;"><i class="fas fa-pdf"></i>PDF</button>
                    </form>
                  </div>
                  {{-- <a href="{{ url('export/excel_service') }}" class="btn btn-success">Export Excel</a> --}}
                  <div class="table-responsive" id="div_table_value" style="display:none;">
                    <table id="table_value" class="table table-striped table-bordered" style="width: 100%">
                        <tr>
                          <th>No</th>
                        </tr>
                        <tr>
                          <td>1</td>
                        </tr>
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
                    &copy; 2022 <a  href="https://www.keluarga-kita.com" class="font-weight-bold ml-1"
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
      $('#btn-reset').hide();
      $('#btn-excel').hide();
      $('#btn-pdf').hide();
      $('#div_table_value').hide();
      $('#end_date').prop("disabled", true);

    $('#start_date').change(function(){
      var start_date_val = $('#start_date').val();
      $('#end_date').prop("disabled", false);
      $('#end_date').attr('min',start_date_val)
    });
  });


      // Form input start_date and end_date
      function search_report() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        // $('#end_date').attr('min', start_date);
        if(start_date == ""){
          alert("Start Date Tidak Boleh Kosong.");
        }else if(end_date == ""){
          alert("End Date Tidak Boleh Kosong.");
        }else {
              // Get data date
              $('#excel_start_date').empty().val(start_date);
              $('#excel_end_date').empty().val(end_date);
              $('#pdf_start_date').empty().val(start_date);
              $('#pdf_end_date').empty().val(end_date);
              $.ajax({
                    async: false,
                    type:'post',
                    url:'{{url('laporan_service/search')}}',
                    data:{ _token : '{{ csrf_token() }}',
                           start_date : start_date,
                           end_date : end_date
                         }
                    ,success:function(response){
                    respon = $.parseJSON(response);
                        if(respon.response == 'success')
                        {
                          var data = respon.search;
                          var tot_data = data.length;
                          var table = "<table class='table table-bordered text-center' id='table_value' cellspacing='0'>"
                                      +"<thead><tr>"
                                        +"<th>No</th>"
                                        +"<th>No Tiket</th>"
                                        +"<th>Nama Pemohon</th>"
                                        +"<th>Department</th>"
                                        +"<th>Unit</th>"
                                        +"<th>Jenis Service</th>"
                                        +"<th>Inventaris</th>"
                                        +"<th>Service</th>"
                                        +"<th>Perkiraan Biaya</th>"
                                        +"<th>Tanggal</th>"
                                        +"<th>Teknisi</th>"
                                        +"<th>Action</th>"
                                      +"</tr>"
                                      +"</thead>"
                                      +"<tbody>";
                          if(tot_data != 0){
                            for(a=0; a<tot_data; a++)
                            {
                                var no = a+1;
                                var id_service = data[a].id_service;
                                var no_tiket = data[a].no_tiket;
                                var pemohon = data[a].pemohon;
                                var department = data[a].department;
                                var unit = data[a].nama_unit;
                                var jenis_inventaris = data[a].jenis_inventaris;
                                var inventaris = data[a].inventaris;
                                var service = data[a].service;
                                var biaya_service = data[a].biaya_service;
                                var tanggal_pengajuan = data[a].created_at;
                                var keterangan = data[a].keterangan;
                                var nama_teknisi = data[a].nama_teknisi;
                                var d = new Date(tanggal_pengajuan),
                                    month = '' + (d.getMonth() + 1),
                                    day = '' + d.getDate(),
                                    year = d.getFullYear();
                                    if (month.length < 2) month = '0' + month;
                                    if (day.length < 2) day = '0' + day;
                                var tanggal_pengajuan = [day, month, year].join('-');
                                var biaya_service = biaya_service.toString(),
                                  sisa 	= biaya_service.length % 3,
                                  rupiah 	= biaya_service.substr(0, sisa),
                                  ribuan 	= biaya_service.substr(sisa).match(/\d{3}/gi);
                                  if (ribuan) {
                                            separator = sisa ? '.' : '';
                                            rupiah += separator + ribuan.join('.');
                                      }
                                  biaya_service = 'Rp. '+rupiah;
                                table = table+"<tr>"
                                            +"<td>"+no+"</td>"
                                            +"<td>"+no_tiket+"</td>"
                                            +"<td>"+pemohon+"</td>"
                                            +"<td>"+department+"</td>"
                                            +"<td>"+unit+"</td>"
                                            +"<td>"+jenis_inventaris+"</td>"
                                            +"<td>"+inventaris+"</td>"
                                            +"<td>"+service+"</td>"
                                            +"<td>"+biaya_service+"</td>"
                                            +"<td>"+tanggal_pengajuan+"</td>"
                                            +"<td>"+keterangan+"</td>"
                                            +"<td>"+nama_teknisi+"</td>"
                                            +"<td><a target='blank_' href='{{ url('laporan_service/search_pdf_single') }}/"+id_service+"' class='btn btn-sm btn-info'><i class='fa fa-print'></i></a></td>"
                                            +"</tr>"
                            };
                              table= table+"</tbody>"
                                          +"</table>";
                            $('#div_table_value').show();
                            $('#table_value').empty().append(table);
                            $('#btn-reset').show();
                            $('#btn-excel').show();
                            $('#btn-pdf').show();
                          }else{
                            table= table+"<tr>"
                                        +"<td colspan='9' class='text-danger'><h1><i>Data Tidak Tersedia</i></h1></td>"
                                        +"</tr>"
                                          +"</tbody>"
                                          +"</table>";
                            $('#div_table_value').show();
                            $('#table_value').empty().append(table);
                          }
                        }else{
                            console.log('Data Tidak Tersedia');
                            alert('Data Tidak Tersedia');
                        }
                    },
                });
        }
      }

    function reset() {
          $('#start_date').val("");
          $('#end_date').val("");
          $('#div_table_value').hide();
          $('#btn-reset').hide();
          $('#btn-excel').hide();
          $('#btn-pdf').hide();
    }

  </script>
@endsection
