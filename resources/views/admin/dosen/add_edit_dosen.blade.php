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

                    <form class="form-sample" @if(empty($dosen['id'])) action="{{ route('addEditDosen') }}" @else action="{{ route('addEditDosen', $dosen['id']) }}" @endif method="post" name="addEditDosentForm" id="addEditDosentForm" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="nik">NIK</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nik" class="form-control" id="nik" @if(!empty($dosen['nik'])) value="{{ $dosen['nik'] }}" @else value="{{ old('nik') }}" @endif placeholder="NIK Dosen">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="nama">Nama Dosen</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" class="form-control" id="nama" @if(!empty($dosen['nama'])) value="{{ $dosen['nama'] }}" @else value="{{ old('nama') }}" @endif placeholder="Nama Dosen">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="program_studi">Program Studi</label>
                                    <div class="col-sm-9">
                                        <select name="program_studi" id="program_studi" class="form-control text-dark">
                                            <option value="">Select</option>
                                            <option value="Teknik Pertambangan" @if(!empty($dosen['program_studi'])) selected @endif>Teknik Pertambangan</option>
                                            <option value="Perencanaan Wilayah dan Kota" @if(!empty($dosen['program_studi'])) selected @endif>Perencanaan Wilayah dan Kota</option>
                                            <option value="Teknik Industri" @if(!empty($dosen['program_studi'])) selected @endif>Teknik Industri</option>
                                            <option value="Program Profesi Insinyur" @if(!empty($dosen['program_studi'])) selected @endif>Program Profesi Insinyur</option>
                                            <option value="Magister Perencanaan Wilayah dan Kota" @if(!empty($dosen['program_studi'])) selected @endif>Magister Perencanaan Wilayah dan Kota</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="email">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" id="email" @if(!empty($dosen['email'])) value="{{ $dosen['email'] }}" @else value="{{ old('email') }}" @endif placeholder="Email Dosen">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="telepon">No. Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="telepon" class="form-control" id="telepon" @if(!empty($dosen['telepon'])) value="{{ $dosen['telepon'] }}" @else value="{{ old('telepon') }}" @endif placeholder="No. Telepon Dosen">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tipe">Tipe Dosen</label>
                                    <div class="col-sm-9">
                                        <select name="tipe" id="tipe" class="form-control text-dark">
                                            <option value="">Select</option>
                                            <option value="Internal" @if(!empty($dosen['tipe'])) selected @endif>Internal</option>
                                            <option value="Eksternal" @if(!empty($dosen['tipe'])) selected @endif>Eksternal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="foto">Foto (Rekomendasi Ukuran: 1000pixels x 1000pixels)</label>
                            <div class="col-sm-9">
                                <input type="file" name="foto" class="form-control" id="foto">
                                @if(!empty($dosen->foto))
                                <a target="_blank" href="{{ url('/admin/foto/dosen/'. $dosen->foto) }}">Lihat Foto</a>&nbsp;|&nbsp;
                                <a href="javascript:void(0)" class="confirm-delete" module="dosen-foto" module_id="{{ $dosen['id'] }}" module_name=" {{ $dosen['foto'] }}">Hapus</a>
                                <input type="hidden" name="current_foto" id="current_foto" value="{{ $dosen->foto }}">
                                @endif
                            </div>
                        </div>

                        @if (!empty($dosen['id']))
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="telepon">Plot Sebagai Koordinator Skripsi</label>
                            <div class="col-sm-9">
                                @if ($dosen['status_koordinator']==1)
                                <a href="javascript:void(0)" class="updateDosenStatus" id="dosen-{{ $dosen['id'] }}" dosen_id="{{ $dosen['id'] }}">
                                    <i class="mdi mdi-bookmark-check" style="font-size:25px" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updateDosenStatus" id="dosen-{{ $dosen['id'] }}" dosen_id="{{ $dosen['id'] }}">
                                    <i class="mdi mdi-bookmark-outline" style="font-size:25px" status="Inactive"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('viewDosen') }}" class="btn btn-light">Batal</a>
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