@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
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

                    <form class="form-sample" @if(empty($mahasiswa['id'])) action="{{ route('addEditMahasiswa') }}" @else action="{{ route('addEditMahasiswa', $mahasiswa['id']) }}" @endif method="post" name="addEditMahasiswatForm" id="addEditMahasiswatForm" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="npm">NPM</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="npm" class="form-control" id="npm" @if(!empty($mahasiswa['npm'])) value="{{ $mahasiswa['npm'] }}" @else value="{{ old('npm') }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="nama">Nama Mahasiswa</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" class="form-control" id="nama" @if(!empty($mahasiswa['nama'])) value="{{ $mahasiswa['nama'] }}" @else value="{{ old('nama') }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="program_studi">Program Studi</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="program_studi" class="form-control" id="program_studi" @if(!empty($mahasiswa['program_studi'])) value="{{ $mahasiswa['program_studi'] }}" @else value="{{ old('program_studi') }}" @endif readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="email">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" id="email" @if(!empty($mahasiswa['email'])) value="{{ $mahasiswa['email'] }}" @else value="{{ old('email') }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="telepon">No. Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="telepon" class="form-control" id="telepon" @if(!empty($mahasiswa['telepon'])) value="{{ $mahasiswa['telepon'] }}" @else value="{{ old('telepon') }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="angkatan">Angkatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="angkatan" class="form-control" id="angkatan" @if(!empty($mahasiswa['angkatan'])) value="{{ $mahasiswa['angkatan'] }}" @else value="{{ old('angkatan') }}" @endif readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('viewMahasiswa') }}" class="btn btn-light">Batal</a>
                            </div>
                            <div class="col-sm-9">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection