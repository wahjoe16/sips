@extends('dosen.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>

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

                    <form class="form-sample" action="{{ route('showDaftarSidang', $sidang->id) }}" method="post">@csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Informasi Skripsi Mahasiswa</p>
                                        <img src="{{ url('/mahasiswa/foto/'. $sidang->mahasiswa['foto'] ?? '/') }}" alt="" width="200px">
                                        <br><br>
                                        <address>
                                            <p>Nama</p>
                                            <p class="font-weight-bold">{{ $sidang->mahasiswa['nama'] }}</p><br>
                                            <p>NPM</p>
                                            <p class="font-weight-bold">{{ $sidang->mahasiswa['npm'] }}</p><br>
                                            <p>Angkatan</p>
                                            <p class="font-weight-bold">{{ $sidang->mahasiswa['angkatan'] }}</p><br>
                                            <p>Judul Skripsi</p>
                                            <p class="font-weight-bold">{{ $sidang->judul_skripsi }}</p><br>
                                            <p>Dosen Pembimbing 1</p>
                                            <p class="font-weight-bold">{{ $sidang->dosen_1['nama'] }}</p><br>
                                            <p>Dosen Pembimbing 2</p>
                                            <p class="font-weight-bold">{{ $sidang->dosen_2['nama'] }}</p><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Persyaratan</p>
                                        <div class="row">
                                            @if ($sidang->mahasiswa['program_studi']=='Perencanaan Wilayah dan Kota')
                                            <ul class="list-arrow">
                                                <li><a href="{{ url('/mahasiswa/sidang/syarat01', $sidang->syarat_1) }}" target="_blank">Bukti pembayaran sidang terbuka</a></li>
                                                <li><a href="{{ url('/mahasiswa/sidang/syarat02', $sidang->syarat_2) }}" target="_blank">Hasil pemeriksaan resmi turnitin</a></li>
                                                <li><a href="{{ url('/mahasiswa/sidang/syarat03', $sidang->syarat_3) }}" target="_blank">Transkrip nilai</a></li>
                                            </ul>

                                            @elseif ($sidang->mahasiswa['program_studi']=='Teknik Industri')

                                            @elseif ($sidang->mahasiswa['program_studi']=='Teknik Pertambangan')
                                            <ul class="list-arrow">
                                                <li><a href="{{ url('/mahasiswa/sidang/syarat01', $sidang->syarat_1) }}" target="_blank">Transkrip Nilai</a></li>
                                                <li><a href="{{ url('/mahasiswa/sidang/syarat02', $sidang->syarat_2) }}" target="_blank">Sertifikat Pesantren Calon Sarjana</a></li>
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div><br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status Approval</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('status') is-invalid @enderror select2 dynamic" style="width: 100%;" name="status" id="status">
                                            <option value="" disabled selected>==Verikasi==</option>
                                            <option value="2" @if($sidang->status==2) selected @endif>Ditolak</option>
                                            <option value="1" @if($sidang->status==1) selected @endif>Diterima</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Masukan Keterangan"></textarea>
                                        @error('keterangan') <span class="text-muted">{{$message}}</span> @enderror
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection