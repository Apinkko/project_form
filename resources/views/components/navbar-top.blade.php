<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <h1 class="title-text">Aplikasi Form RSKK</h1>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="media align-items-center">
                          @if (Auth::user()->gender_id == 1)
                          <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('assets/img/theme/male.png') }}">
                          </span>
                            @else
                            <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="{{ asset('assets/img/theme/female.png') }}">
                            </span>
                          @endif
                          <div class="media-body  ml-2  d-none d-lg-block">
                              <span class="mb-0 text-sm  font-weight-bold text-primary">{{ Auth::user()->nama }}</span>
                          </div>
                      </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                      <div class="dropdown-header noti-title">
                          <h6 class="text-overflow m-0 text-primary">Selamat Datang!</h6>
                      </div>
                      <div class="dropdown-divider"></div>
                      <a href="" class="dropdown-item text-primary" data-toggle="modal" data-target="#ModalUbahPassword">Ubah Passowrd</a>
                      <a href="#" class="dropdown-item text-danger"
                      onclick="event.preventDefault(); document.getElementById('user-form').submit()">Log Out</a>
                      <form id="user-form" action="{{ route('logout') }}" method="post" style="display: none;">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      </form>
                    </div>
                    <!-- Modal Ubah Passowrd -->
                    <div class="modal fade" id="ModalUbahPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Ubah Password, {{ auth::user()->nama }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form action="{{ url('ubah_password') }}" method="post">
                          @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                  <label>Password Lama Anda</label>
                                  <input type="password" name="password_old" class="form-control" placeholder="Passsword Lama Anda" required >
                                </div>
                                <div class="form-group">
                                  <label>Password Baru Anda</label>
                                  <input type="password" name="password_new" class="form-control" placeholder="Passsword Baru Anda" required >
                                </div>
                                <div class="form-group">
                                  <label>Confirm Password Baru</label>
                                  <input type="password" name="confirm_password_new" class="form-control" placeholder="Confirm Passsword Baru Anda" required >
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin?')">Save changes</button>
                            </div>
                        </form>
                        </div>
                      </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
