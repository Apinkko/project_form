<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Form Permohonan Service</title>
    <style>
        .parent {
            width: 50%;
              display: grid;
              grid-template-columns: repeat(2, 1fr);
              grid-template-rows: 1fr;
              grid-column-gap: px;
              grid-row-gap: px;
                }
        .garis_verikal{
                        border-left: 1px black solid;
                        height: 170px;
                        width: 0px;
                        }
    </style>
</head>
<body>
    <div class="row">
      <div class="col-md-5">
          <img src="{{ url('/rskklogo-02.png') }}" alt="" style="max-height: 3.26rem;">
      </div>
      <div class="col-md-6 mb-5 text-center">
          <h2 class="fw-bold">Form Permohonan Service</h2>
      </div>
    </div>
    <table style="width:50%; font-size:12px; table-layout: fixed; word-break:break-all; word-wrap:break-word;">
      <tr>
          <td>Kepada Yth</td>
          <td>: General/IT Service</td>
      </tr>
      <tr>
          <td>Department</td>
          <td>: {{ $data_service->user->department->department }}</td>
      </tr>
      <tr>
          <td>Tanggal Permohonan</td>
          <td>: {{ $data_service->created_at->format('d/M/Y') }}</td>
      </tr>
      <tr>
          <td>Jenis Service</td>
          <td>: {{ $data_service->inventaris->jenis_inventaris->jenis_inventaris }}</td>
      </tr>
      <tr>
          <td>Iventaris</td>
          <td>: {{ $data_service->inventaris->nama }}</td>
      </tr>
      <tr>
          <td>Service Perbaikan/Tindakan</td>
          <td>: {{ $data_service->service }}</td>
      </tr>
      <tr>
          <td>Biaya</td>
          <td>: Rp. {{ number_format($data_service->biaya_service) }} ,-</td>
      </tr>
      <tr>
          <td>Teknisi</td>
          <td>: {{ $data_service->teknisi->nama }}</td>
      </tr>
    </table>

    <br>
      <div class="card text-center">
        <table class="text-center" style="width:100%; font-size: 12px;">
          <tr>
            <th>Meyetujui</th>
            <th>Pemohon</th>
          </tr>
            <br><br>
            <br><br>
          <tr>
            <td>( {{ $manager->nama }} )</td>
            <td>( {{ $data_service->user->nama }} )</td>
          </tr>
        </table>
      </div>
      <div class="card" style="font-size: 12px;">
        <div>Keterangan : {{ $data_service->keterangan }}</div>
        <br>
        <br>
      </div>
</body>
</html>
