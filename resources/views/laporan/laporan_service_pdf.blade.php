<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Laporan Pdf</title>

    <style>
      th {
        text-align: center;
      }
    </style>
</head>
<body>
    <div class="row">
      <div class="col-md-5">
          <img src="{{ url('/rskklogo-02.png') }}" alt="" style="max-height: 3.26rem;">
      </div>
      <div class="col-md-6 mb-5 text-center">
          <h2 class="fw-bold">Permohonan Service</h2><br>
          <p>{{ date('d/M/Y', strtotime($start_date)).' s/d '.date('d/M/Y', strtotime($end_date)) }}</p>
      </div>
      <table class="table table-striped table-bordered" style="font-size:10px; table-layout: fixed; word-break:break-all; word-wrap:break-word;">
        <tr style="background-color:skyblue">
          <th style="width:5%;">No</th>
          <th style="width:7%;">No.Tiket</th>
          <th style="width:15%;">Nama Pemohon</th>
          <th>Department</th>
          <th style="width:6%;">Jenis Service</th>
          <th style="width:15%;">Inventaris/Tindakan</th>
          <th style="width:20%;">Service/Perbaikan</th>
          <th style="width:7%;">Biaya Service</th>
          <th>Tanggal</th>
          {{-- <th style="width: 100px;">Keterangan</th> --}}
          <th style="width:6%;">Teknisi</th>
        </tr>
        @php $no=1; @endphp
        @foreach ($data_service as $val)
          <tr>
            <td style="width:5%;">{{ $no++ }}</td>
            <td style="width:6%;">{{ $val->no_tiket }}</td>
            <td style="width:15%;">{{ $val->pemohon }}</td>
            <td>{{ $val->department }}</td>
            <td style="width:6%;">{{ $val->jenis_inventaris }}</td>
            <td style="width:15%;">{{ $val->inventaris }}</td>
            <td style="width:20%;">{{ $val->service }}</td>
            <td style="width:7%;">{{ $val->biaya_service }}</td>
            <td>{{ $val->created_at->format('d-m-Y') }}</td>
            {{-- <td style="width: 100px;">{{ $val->keterangan }}</td> --}}
            <td style="width:6%;">{{ $val->nama_teknisi }}</td>
          </tr>
        @endforeach
      </table>
    </div>
</body>
</html>
