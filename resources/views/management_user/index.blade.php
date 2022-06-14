@extends('layouts.app')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
      <div class="header-body">
          <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                  <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
                  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                          <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                          <li class="breadcrumb-item"><a href="{{ url('management_user') }}">Management User</a></li>
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
                                  <h5 class="modal-title text-dark" id="exampleModalLabel">Management User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <form action="{{ url('management_user/store') }}" method="post">
                                      @csrf
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="">Nama</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}" required>
                                          </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="">Nik</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" name="nik" class="form-control" placeholder="Nik" value="{{ old('nik') }}" maxlength="16" required>
                                          </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="">Username</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                                          </div>
                                    </div>
                                    {{-- <div class="form-group">
                                      <div class="col-md-6">
                                          <label for="">Email</label>
                                      </div>
                                      <div class="col-md-12">
                                          <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                                        </div>
                                   </div> --}}
                                   <div class="form-group">
                                      <div class="col-md-6">
                                          <label for="">Password</label>
                                      </div>
                                      <div class="col-md-12">
                                          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" required>
                                          @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                          @enderror
                                        </div>
                                   </div>
                                   <div class="form-group">
                                      <div class="col-md-6">
                                          <label for="">Password Confirmation</label>
                                      </div>
                                      <div class="col-md-12">
                                          <input type="password" name="password_confirmed" class="form-control @error('password_confirmed') is-invalid @enderror" placeholder="Password Confimation" value="{{ old('confirmed') }}" required>
                                          @error('password_confirmed')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                        </div>
                                   </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="gender_id">Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-12">
                                          @foreach ($genders as $gender)
                                              <input id="gender_id" type="radio" name="gender_id" value="{{ $gender->id }}" required> {{ $gender->gender }}
                                          @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="exampleFormControlInput1">Department</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select name="department_id" id="department_id" class="form-control" required>
                                                   <option value="">-Pilih-</option>
                                                @foreach ($departments as $department)
                                                   <option value="{{ $department->id }}">{{ $department->department }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="exampleFormControlInput1">Unit</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select name="unit_id" id="unit_id" class="form-control">
                                                   <option value="">-Harap di Kosongkan Jika jabatan SPV/MANAGER-</option>
                                                @foreach ($units as $unit)
                                                   <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="exampleFormControlInput1">Jabatan</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select name="jabatan_id" id="jabatan_id" class="form-control" required>
                                                <option value="">-Pilih-</option>
                                                @foreach ($jabatans as $jabatan)
                                                    <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                              data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary" onclick="return confirm('Apa Anda Yakin Dengan Data Anda?')">Simpan</button>
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
                  <h3 class="mb-0 text-dark">Management User</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-data" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Department</th>
                        @if (Auth::user()->jabatan_id == 1)
                          <th>Unit</th>
                         @endif
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->gender->gender }}</td>
                        <td>{{ $user->department->department}}</td>
                        @if (Auth::user()->jabatan_id == 1)
                         <td>{{ $service->user->unit->nama_unit}}</td>
                        @endif
                        <td>{{ $user->jabatan->jabatan }}</td>
                        <td>{{ $user->status->status }}</td>
                        <td>
                            <div class="aksi" id="aksi">
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#edit{{ $user->id }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <br>
                                <!-- Modal -->
                                <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h5 class="modal-title" id="exampleModalLabel">Management User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('management_user/update', $user->id) }}" method="post">
                                                  @method('PATCH')
                                                  @csrf
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label for="">Nama</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" placeholder="Nama" required>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label for="">Nik</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="number" name="nik" class="form-control" value="{{ $user->nik }}" placeholder="Nik" required>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label for="">Username</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="text" name="username" class="form-control" value="{{ $user->username }}" placeholder="Username" required>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group">
                                                  <div class="col-md-6">
                                                      <label for="">Email</label>
                                                  </div>
                                                  <div class="col-md-12">
                                                      <input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Email" required>
                                                  </div>
                                              </div> --}}
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="">Password</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" required>
                                                    @error('password')
                                                      <div class="invalid-feedback">
                                                          {{ $message }}
                                                      </div>
                                                    @enderror
                                                  </div>
                                              </div>
                                             <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="">Password Confirmation</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="password" name="password_confirmed" class="form-control @error('password_confirmed') is-invalid @enderror" placeholder="Password Confimation" value="{{ old('password_confirmed') }}" required>
                                                    @error('password_confirmed')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                  </div>
                                             </div>
                                              <div class="form-group">
                                                  <div class="col-md-12">
                                                      <label for="exampleFormControlInput1">Gender</label>
                                                  </div>
                                                  <div class="col-md-12">
                                                    @foreach ($genders as $gender)
                                                      @if ($user->gender_id == $gender->id)
                                                        <input type="radio" name="gender_id" value="{{ $gender->id }}" checked>{{ $gender->gender }}
                                                      @else
                                                        <input type="radio" name="gender_id" value="{{ $gender->id }}">{{ $gender->gender }}
                                                      @endif
                                                    @endforeach
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="exampleFormControlInput1">Department</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <select name="department_id" id="department_id" class="form-control">
                                                            @foreach ($departments as $department)
                                                              @if ($user->department_id == $department->id)
                                                                <option value="{{ $department->id }}" selected>{{ $department->department }}</option>
                                                              @else
                                                                <option value="{{ $department->id }}">{{ $department->department }}</option>
                                                              @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                              </div>
                                              <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="exampleFormControlInput1">Unit</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <select name="unit_id" id="unit_id" class="form-control">
                                                            @foreach ($units as $unit)
                                                              @if ($user->unit_id == $unit->id)
                                                                <option value="{{ $unit->id }}" selected>{{ $unit->nama_unit }}</option>
                                                              @else
                                                                <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                                                              @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                              </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="exampleFormControlInput1">Jabatan</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                      <select name="jabatan_id" id="jabatan_id" class="form-control">
                                                        @foreach ($jabatans as $jabatan)
                                                          @if ($user->jabatan_id == $jabatan->id)
                                                            <option value="{{ $jabatan->id }}" selected>{{ $jabatan->jabatan }}</option>
                                                          @else
                                                            <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan }}</option>
                                                          @endif
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="exampleFormControlInput1">Status</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                      <select name="status_id" id="status_id" class="form-control">
                                                        @foreach ($statuses as $status)
                                                          @if ($user->status_id == $status->id)
                                                            <option value="{{ $status->id }}" selected>{{ $status->status }}</option>
                                                          @else
                                                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                                                          @endif
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary"
                                                          data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Dengan Data Anda?')">Save changes</button>
                                                  </div>
                                              </form>
                                          </div>
                                        </div>
                                    </div>
                                </div>
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
                  &copy; 2022 <a  href="https://keluarga-kita.com" class="font-weight-bold ml-1"
                      target="_blank">Rumah Sakit Keluarga Kita - Developer Alfin Nurhidayat</a>
              </div>
          </div>
      </div>
  </footer>
</div>

@endsection
