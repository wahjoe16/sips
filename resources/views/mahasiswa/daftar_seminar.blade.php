@extends('mahasiswa.layout.layout')
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

                    @if(is_null($daftarSeminar) || $daftarSeminar->status == 2)

                    @if($slug == 'Teknik Pertambangan')
                    <form class="form-sample" action="{{ route('daftarSeminar', 'Teknik Pertambangan') }}" method="post" enctype="multipart/form-data">@csrf
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
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tahun_ajaran_id">Judul Skripsi</label>
                                            <div class="col-sm-9">
                                                <textarea name="judul_skripsi" class="form-control" id="" cols="30" rows="10"></textarea>
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
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_1">Bukti pembayaran Kolokium Skripsi</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_1" class="form-control" id="syarat_1">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_2">Sertifikat TOEFL</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_2" class="form-control" id="syarat_2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_3">Transkrip nilai</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_3" class="form-control" id="syarat_3">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_4">Formulir nilai bimbingan skripsi</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_4" class="form-control" id="syarat_4">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_5">Formulir kemajuan bimbingan skripsi</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_5" class="form-control" id="syarat_5">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_6">Formulir persetujuan kolokium skripsi</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_6" class="form-control" id="syarat_6">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_7">Formulir kesediaan menghadiri kolokium skripsi</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_7" class="form-control" id="syarat_7">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_8">Pas foto ukuran 4 x 6 sebanyak 2 lembar</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_8" class="form-control" id="syarat_8">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_9">Kartu Tanda Mahasiswa</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_9" class="form-control" id="syarat_9">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_10">Bukti pembayaran kuliah</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_10" class="form-control" id="syarat_10">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_11">Bukti perwalian</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_11" class="form-control" id="syarat_11">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_12">Bukti bebas pinjaman perpustakaan</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_12" class="form-control" id="syarat_12">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_13">Sertifikat pesantren calon sarjana</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_13" class="form-control" id="syarat_13">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_14">Keterangan menghadiri kolokium skripsi (7 kali)</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_14" class="form-control" id="syarat_14">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_15">Draft skripsi (PDF)</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_15" class="form-control" id="syarat_15">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_16">Draft skripsi (DOCX)</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_16" class="form-control" id="syarat_16">
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

                    @if($slug == 'Teknik Industri')
                    <form class="form-sample" action="{{ route('daftarSeminar', 'Teknik Industri') }}" method="post" enctype="multipart/form-data">@csrf
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
                    <form class="form-sample" action="{{ route('daftarSeminar', 'Perencanaan Wilayah dan Kota') }}" method="post" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Informasi Sidang Pembahasan Perencanaan Wilayah dan Kota</p>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tahun_ajaran_id">Tahun Ajaran / Semester</label>
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
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_1">Bukti pembayaran sidang pembahasan</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_1" class="form-control dropify" id="syarat_1">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_2">Sertifikat pesantren mahasiswa baru dan sarjana</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_2" class="form-control dropify" id="syarat_2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_3">Transkrip nilai</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_3" class="form-control dropify" id="syarat_3">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_4">Sertifikat TOEFL</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_4" class="form-control dropify" id="syarat_4">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_5">Bukti bebas pinjaman perpustakaan</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_5" class="form-control dropify" id="syarat_5">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_6">Bukti bebas koperasi mahasiswa</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_6" class="form-control dropify" id="syarat_6">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputEmail2" class="col-sm-5 col-form-label" for="syarat_7">Sertifikat SKKFT</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="syarat_7" class="form-control dropify" id="syarat_7">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">

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

                    @elseif ($daftarSeminar->status == 0)
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

                    @elseif ($daftarSeminar->status == 1)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Selamat!</h4>
                                    <button type="button" class="btn btn-outline-success btn-fw">Pengajuan anda sudah disetujui, Silahkan lanjutkan ke tahap selanjutnya.</button>
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

<script>
    $('.dropify').dropify();
</script>