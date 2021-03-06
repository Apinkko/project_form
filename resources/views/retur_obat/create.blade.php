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
                            <li class="breadcrumb-item"><a href="#">Tambah Retur Obat</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form</li>
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
                    <h3 class="mb-0">Tambah Retur Obat</h3>
                </div>
                <div class="card-body p-4">
                   <!-- form table -->
                    <form action="{{ url('retur_obat/store') }}" method="post">
                      @csrf
                      <div class="row mb-4">
                          <div class="col-md-4">
                            <label for="" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" name="nama_pasien" placeholder="Nama Pasien" value="" required>
                          </div>
                          <div class="col-md-4">
                            <label for="" class="form-label">No. RM</label>
                            <input type="text" class="form-control" name="no_rm" placeholder="No rm" value="" required>
                          </div>
                          <div class="col-md-4">
                            <label for="" class="form-label">Ruangan</label>
                            <input type="text" class="form-control" name="ruangan" placeholder="Ruangan" value="" required>
                          </div>
                      </div>
                      <div id="div_data_obat">
                        <div class="row mb-2" id="data_obat0">
                            <div class="col-md-3">
                              <label for="" class="form-label">Nama Obat/ALkes</label>
                              <input type="text" class="form-control" name="obat_alkes[]" placeholder="Nama Obat/ALkes" value="" required>
                            </div>
                            <div class="col-md-2">
                              <label for="" class="form-label">Jumlah</label>
                              <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" value="" required>
                            </div>
                            <div class="col-md-2">
                              <label for="" class="form-label">Satuan</label>
                              <input type="text" class="form-control" name="satuan[]" placeholder="Satuan" value="" required>
                            </div>
                            <div class="col-md-2">
                              <label for="" class="form-label">No. Batch</label>
                              <input type="text" class="form-control" name="no_batch[]" placeholder="No Batch" value="" required>
                            </div>
                            <div class="col-md-3">
                              <label for="" class="form-label">Expired Date</label>
                              <input type="date" class="form-control" name="expired_date[]" placeholder="Epired Date" value="" required>
                            </div>
                            <div class="col-md-12 mt-1">
                              <label for="" class="form-label">Keterangan</label>
                              <textarea type="textarea" class="form-control" name="keterangan[]" placeholder="Keterangan" rows="2"></textarea>
                            </div>
                          </div>
                        </div>
                      <button type="button" class="btn btn-sm btn-info" id="button_tambah_data" onclick="tambah_kolom()"><i class="fas fa-plus"></i></button>
                      <br><br><br>
                      <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin?')"><i class="fas fa-save"></i> Save</button>
                      <a href="{{ url('retur_obat') }}" class="btn btn-secondary"><i class="fas fa-reply"></i> Back</a>
                    </form>
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

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    console.log("Ready!");


  });
  function tambah_kolom(){
  var get_id = $('#div_data_obat > div').length;
  // var get_id = jml-1;
  var id_div = "data_obat"+get_id;
   var kolom = "<div class='row mb-2' id="+id_div+">"
                  +"<div class='col-md-3 mt-4'>"
                      +"<button type='button' class='btn btn-sm btn-danger' id='button_tambah_data' onclick='minus_kolom("+get_id+")'><i class='fas fa-minus'></i></button>"
                      +"<label for='' class='form-label'>Nama Obat/ALkes</label>"
                      +"<input type='text' class='form-control' name='obat_alkes[]' placeholder='Nama Obat/ALkes' value='' required>"
                  +"</div>"
                  +"<div class='col-md-2 mt-4'>"
                        +"<label for='' class='form-label'>Jumlah</label>"
                        +"<input type='number' class='form-control' name='jumlah[]' placeholder='Jumlah' value='' required>"
                  +"</div>"
                  +"<div class='col-md-2 mt-4'>"
                      +"<label for='' class='form-label'>Satuan</label>"
                      +"<input type='text' class='form-control' name='satuan[]' placeholder='Satuan' value='' required>"
                  +"</div>"
                  +"<div class='col-md-2 mt-4'>"
                      +"<label for='' class='form-label'>No. Batch</label>"
                      +"<input type='text' class='form-control' name='no_batch[]' placeholder='No Batch' value='' required>"
                  +"</div>"
                  +"<div class='col-md-3 mt-4'>"
                      +"<label for='' class='form-label'>Expired Date</label>"
                      +"<input type='date' class='form-control' name='expired_date[]' placeholder='Epired Date' value='' required>"
                  +"</div>"
                  +"<div class='col-md-12 mt-1'>"
                        +"<label for='' class='form-label'>Keterangan</label>"
                        +"<textarea type='textarea' class='form-control' name='keterangan[]' placeholder='Keterangan' rows='2'></textarea>"
                  +"</div>"
                +"</div>";
    $('#div_data_obat').append(kolom);
  }

  function minus_kolom(id) {
    var divnya = "data_obat"+id;
    $('#'+divnya).remove();
  }
</script>

@endsection
