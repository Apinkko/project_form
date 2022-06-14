{{-- @dd(Route::currentRouteName()) --}}
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
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
                      @if (Auth::user()->department_id == 1)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName('management_user') == 'management_user' ? 'active' : '' }}" href="{{ route('management_user') }}">
                                <i class="fas fa-users text-primary"></i>
                                <span class="nav-link-text ">Management User</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('management_obat') }}">
                                <i class="fas fa-medkit text-primary"></i>
                                <span class="nav-link-text ">Management Obat</span>
                            </a>
                        </li>  --}}
                      @endif
                        <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName('management_inventaris') == 'management_inventaris' ? 'active' : '' }}" href="{{ url('management_inventaris') }}">
                              <i class="fas fa-toolbox text-primary"></i>
                              <span class="nav-link-text ">Management Inventaris</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName('request_service') == 'request_service' ? 'active' : '' }}" href="{{ url('request_service') }}">
                              <i class="fas fa-hand-holding text-primary"></i>
                              <span class="nav-link-text">Request Service <i class="fas fa-bell text-danger" id="bell_request_service">(1)</i></span>
                          </a>
                        </li>
                    @endif
                      <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName('service.index') == 'service.index' ? 'active' : '' }}" href="{{ route('service.index') }}">
                              <i class="fas fa-tools text-primary"></i>
                              <span class="nav-link-text">Service <i class="fas fa-bell text-danger" id="bell_service">(0)</i></span>
                          </a>
                      </li>
                    @if (Auth::user()->jabatan_id == 3 || Auth::user()->department_id == 1)
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

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    console.log("Ready!");
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
