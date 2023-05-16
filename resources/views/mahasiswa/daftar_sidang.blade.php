@extends('mahasiswa.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pendaftaran Sidang</h4>
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

                    @if(is_null($sidang)|| $sidang->status == 2)

                    @if($slug == 'Teknik Pertambangan')
                    <form class="form-sample" action="{{ route('daftarSidang', 'Teknik Pertambangan') }}" method="post" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Informasi Sidang Skripsi Teknik Pertambangan</p>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tahun_ajaran_id">Tahun Ajaran - Semester</label>
                                            <div class="col-sm-9">
                                                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($tahunAjaran as $ta)
                                                    <option value="{{ $ta['id'] }}">{{ $ta['tahun_ajaran'] }} - {{ $ta['semesterx']['semester'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="judul_skripsi">Judul Skripsi</label>
                                            <div class="col-sm-9">
                                                <textarea name="judul_skripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="dosen1_id">Dosen Pembimbing 1</label>
                                            <div class="col-sm-9">
                                                <select name="dosen1_id" id="dosen1_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($dosen as $d)
                                                    <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="dosen2_id">Dosen Pembimbing 2</label>
                                            <div class="col-sm-9">
                                                <select name="dosen2_id" id="dosen2_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($dosen as $d)
                                                    <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Upload Persyaratan</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="file" name="syarat_1" class="dropify" id="syarat_1">
                                                        <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_1">Transkrip Nilai</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="file" name="syarat_2" class="dropify" id="syarat_2">
                                                        <p for="exampleInputEmail2" class="col-form-label text-center" for="syarat_2">Sertifikat Pesantren Calon Sarjana</p>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                        <a href="{{ route('dashboardMahasiswa') }}" class="btn btn-light">Batal</a>
                                    </div>
                                    <div class="col-sm-9">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    @endif

                    @if($slug == 'Teknik Industri')
                    <form class="form-sample" action="{{ route('daftarSidang', 'Teknik Industri') }}" method="post" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Informasi Sidang Skripsi Teknik Industri</p>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tahun_ajaran_id">Tahun Ajaran - Semester</label>
                                            <div class="col-sm-9">
                                                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($tahunAjaran as $ta)
                                                    <option value="{{ $ta['id'] }}">{{ $ta['tahun_ajaran'] }} - {{ $ta['semesterx']['semester'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tahun_ajaran_id">Judul Skripsi</label>
                                            <div class="col-sm-9">
                                                <textarea name="judul_skripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="dosen1_id">Dosen Pembimbing 1</label>
                                            <div class="col-sm-9">
                                                <select name="dosen1_id" id="dosen1_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($dosen as $d)
                                                    <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="dosen2_id">Dosen Pembimbing 2</label>
                                            <div class="col-sm-9">
                                                <select name="dosen2_id" id="dosen2_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($dosen as $d)
                                                    <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Upload Persyaratan</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_1">Syarat 1</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_1" class="form-control" id="syarat_1">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_2">Syarat 2</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_2" class="form-control" id="syarat_2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_1">Syarat 3</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_3" class="form-control" id="syarat_3">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_1">Syarat 4</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_4" class="form-control" id="syarat_4">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_1">Syarat 5</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_5" class="form-control" id="syarat_5">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_1">Syarat 6</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_6" class="form-control" id="syarat_6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_7">Syarat 7</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_7" class="form-control" id="syarat_7">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_8">Syarat 8</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_8" class="form-control" id="syarat_8">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_9">Syarat 9</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_9" class="form-control" id="syarat_9">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_10">Syarat 10</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_10" class="form-control" id="syarat_10">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_11">Syarat 11</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_11" class="form-control" id="syarat_11">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="syarat_12">Syarat 12</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="syarat_12" class="form-control" id="syarat_12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                        <a href="{{ route('dashboardMahasiswa') }}" class="btn btn-light">Batal</a>
                                    </div>
                                    <div class="col-sm-9">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    @endif

                    @if($slug == 'Perencanaan Wilayah dan Kota')
                    <form class="form-sample" action="{{ route('daftarSidang', 'Perencanaan Wilayah dan Kota') }}" method="post" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Informasi Sidang Skripsi Perencanaan Wilayah dan Kota</p>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tahun_ajaran_id">Tahun Ajaran - Semester</label>
                                            <div class="col-sm-9">
                                                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($tahunAjaran as $ta)
                                                    <option value="{{ $ta['id'] }}">{{ $ta['tahun_ajaran'] }} / {{ $ta['semesterx']['semester'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tahun_ajaran_id">Judul Skripsi</label>
                                            <div class="col-sm-9">
                                                <textarea name="judul_skripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="dosen1_id">Dosen Pembimbing 1</label>
                                            <div class="col-sm-9">
                                                <select name="dosen1_id" id="dosen1_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($dosen as $d)
                                                    <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="dosen2_id">Dosen Pembimbing 2</label>
                                            <div class="col-sm-9">
                                                <select name="dosen2_id" id="dosen2_id" class="form-control text-dark">
                                                    <option value="">Pilih</option>
                                                    @foreach($dosen as $d)
                                                    <option value="{{ $d['id'] }}">{{ $d['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Upload Persyaratan</p>

                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_1">Bukti pembayaran sidang terbuka</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="syarat_1" class="dropify" id="syarat_1">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_2">Hasil pemeriksaan resmi turnitin</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="syarat_2" class="dropify" id="syarat_2">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_1">Transkip nilai</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="syarat_3" class="dropify" id="syarat_3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                        <a href="{{ route('dashboardMahasiswa') }}" class="btn btn-light">Batal</a>
                                    </div>
                                    <div class="col-sm-9">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    @endif

                    @elseif ($sidang->status == 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pendaftaran Sidang di Block!</h4>
                                    <button type="button" class="btn btn-outline-danger btn-fw">Anda Sudah Mendaftarkan Sidang, Tinggal Menunggu Approval dari Koordinator Sidang Skripsi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @elseif ($sidang->status == 1)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Selamat!</h4>
                                    <button type="button" class="btn btn-outline-success btn-fw">Pengajuan anda sudah disetujui, tinggal menunggu informasi selanjutnya.</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('.dropify').dropify();
</script>
@endpush