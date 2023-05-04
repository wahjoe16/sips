@extends('mahasiswa.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Update Profile</h3>
                    @if(Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error: </strong>{{ Session::get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>Sukses: </strong>{{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form class="" action="{{ route('updateProfileMahasiswa') }}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="NPM">NPM</label>
                            <div class="col-sm-9">
                                <input type="text" name="npm" class="form-control" id="username" value="{{ Auth::guard('mahasiswa')->user()->npm }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="nama">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ Auth::guard('mahasiswa')->user()->nama }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="program_studi">Program Studi</label>
                            <div class="col-sm-9">
                                <select name="program_studi" id="program_studi" class="form-control text-dark">
                                    <option value="">Select</option>
                                    @foreach ([
                                    "Teknik Pertambangan"=>"Teknik Pertambangan",
                                    "Perencanaan Wilayah dan Kota"=>"Perencanaan Wilayah dan Kota",
                                    "Teknik Industri"=>"Teknik Industri"
                                    ] as $programStudi => $prodiLabel)
                                    <option value="{{ $programStudi }}" {{ old("program_studi", $mahasiswa->program_studi)==$programStudi ? "selected" : "" }}>{{ $prodiLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="email">E-mail</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="email" value="{{ Auth::guard('mahasiswa')->user()->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="telepon">Mobile Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="telepon" class="form-control" id="telepon" value="{{ Auth::guard('mahasiswa')->user()->telepon }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="foto">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" name="foto" class="form-control" id="foto">
                                @if(!empty(Auth::guard('mahasiswa')->user()->foto))
                                <a target="_blank" href="{{ url('mahasiswa/foto/'.Auth::guard('mahasiswa')->user()->foto) }}">Lihat Foto</a>
                                <input type="hidden" name="current_mahasiswa_foto" value="{{ Auth::guard('mahasiswa')->user()->foto }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('dashboardMahasiswa') }}" class="btn btn-light">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection