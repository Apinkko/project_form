<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Project Form </title>
    {{-- for cdn select2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon -->
    <link rel="icon" href="{{ url('/assets/img/brand/favicon-32x32.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700') }}">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/argon.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css"> --}}

    {{-- Data Table Ver Bootstrap 4 --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css') }}">

    <!-- main.css -->
    <link rel="stylesheet" href="{{ url('/assets/css/main.css') }}">
    <style>

    </style>
  </head>

<body>

    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
      <div class="scrollbar-inner">
          <!-- Brand -->
          <div class="sidenav-header align-items-center">
              <a class="navbar-brand" href="javascript:void(0)">
                  <img src="{{ asset('assets/img/icons/rskk logo-01.png') }}" class="navbar-brand-img" alt="...">
              </a>
          </div>
          <div class="navbar-inner">
              <!-- Collapse -->
              <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                  <!-- Nav items -->
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName('home') == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                              <i class="ni ni-tv-2 text-primary"></i>
                              <span class="nav-link-text">Dashboard</span>
                          </a>
                      </li>
                      @if (Auth::user()->department_id == 1 || Auth::user()->department_id == 4 || Auth::user()->department_id == 7)
                        @if (Auth::user()->department_id == 1 || Auth::user()->department_id == 4)
                          @if (Auth::user()->department_id == 1)
                                <li class="nav-item">
                                  <a class="nav-link {{ Route::currentRouteName('management_user') == 'management_user' ? 'active' : '' }}" href="{{ route('management_user') }}">
                                      <i class="fas fa-users text-primary"></i>
                                      <span class="nav-link-text ">Management User</span>
                                  </a>
                                </li>
                          @endif
                            {{-- @elseif (Auth::user()->department_id == 1 || Auth::user()->department_id == 4) --}}
                              <li class="nav-item">
                                  <a class="nav-link {{ Route::currentRouteName('management_inventaris') == 'management_inventaris' ? 'active' : '' }}" href="{{ url('management_inventaris') }}">
                                      <i class="fas fa-toolbox text-primary"></i>
                                      <span class="nav-link-text ">Management Inventaris</span>
                                  </a>
                              </li>
                            {{-- <li class="nav-item">
                                  <a class="nav-link" href="{{ url('management_obat') }}">
                                      <i class="fas fa-medkit text-primary"></i>
                                      <span class="nav-link-text ">Management Obat</span>
                                  </a>
                              </li> --}}
                        @endif
                        <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName('request_service') == 'request_service' ? 'active' : '' }}" href="{{ url('request_service') }}">
                              <i class="fas fa-hand-holding text-primary"></i>
                              <span class="nav-link-text">Request Service <i id="bell_request_service"></i></span>
                          </a>
                        </li>
                      @endif
                      <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName('service.index') == 'service.index' ? 'active' : '' }}" href="{{ route('service.index') }}">
                              <i class="fas fa-tools text-primary"></i>
                              <span class="nav-link-text">Service <i id="bell_service"></i></span>
                          </a>
                      </li>
                      @if (Auth::user()->jabatan_id != 1 )
                        <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName('laporan_service') == 'laporan_service' ? 'active' : '' }}" href="{{ url('laporan_service') }}">
                              <i class="fas fa-file text-primary"></i>
                              <span class="nav-link-text">Laporan</span>
                          </a>
                        </li>
                      @endif

                      {{-- @if (Auth::user()->department_id == 1 || Auth::user()->department_id == 5 || Auth::user()->department_id == 6)
                      <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName('retur_obat') == 'retur_obat' ? 'active' : '' }}" href="{{ url('retur_obat') }}">
                              <i class="fas fa-notes-medical text-primary"></i>
                              <span class="nav-link-text ">Return Obat</span>
                          </a>
                      </li>
                      @endif --}}
                  </ul>
                  <!-- Divider -->
              </div>
          </div>
      </div>
    </nav>
      <!-- Main content -->
    <div class="main-content" id="panel">
      @include('components.navbar-top')
        <!-- Header -->
      @yield('content')
    </div>

    <!-- Script -->
<!-- Core -->
<script src="{{ url('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
<script src="{{ url('/assets/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ url('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- Argon JS -->
<script src="{{ url('/assets/js/argon.js?v=1.2.0') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Bel request service in navbar side -->
{{-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> --}}
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script type="text/javascript">
  $(document).ready(function() {
    $('#bell_service').empty();
    $('#bell_request_service').empty();
    // Check Data Request Service for bell
      $.ajax({
          async: false,
          type:'get',
          url:'{{url('request_service/check_data')}}',
          data:{ _token : '{{ csrf_token() }}'}
          ,success:function(response){
          respon = $.parseJSON(response);
              if(respon.response == 'success')
              {
                var data = respon.total_data;
                if(data == 0){
                  $('#bell_request_service').removeAttr('class')
                }else{
                  $('#bell_request_service').removeAttr('class').attr('class', 'fas fa-bell text-danger');
                  $('#bell_request_service').append('('+data+')')
                }

              }else{
                  console.log('Data Tidak Tersedia');
                  alert('Data Tidak Tersedia');
              }
          },
      });
      // Check Data Service for bell
      $.ajax({
          async: false,
          type:'get',
          url:'{{url('check_data/service')}}',
          data:{ _token : '{{ csrf_token() }}'}
          ,success:function(response){
          respon = $.parseJSON(response);
              if(respon.response == 'success')
              {
                var data = respon.total_data_service;
                if(data == 0){
                  $('#bell_service').removeAttr('class');

                }else{
                  $('#bell_service').removeAttr('class').attr('class', 'fas fa-bell text-danger');
                  $('#bell_service').append('('+data+')')
                }

              }else{
                  console.log('Data Tidak Tersedia');
                  alert('Data Tidak Tersedia');
              }
          },
      });
  });

</script>

{{-- Data tables bootstrap 4 --}}
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function(){
      // $('.table-data').DataTable();

      $('.table-data').DataTable({
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ]
      });

  });
</script>

 </body>
</html>

