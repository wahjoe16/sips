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

                    <form class="form-sample" action="{{ route('showDaftarSeminar', $seminar->id) }}" method="post">@csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Informasi Skripsi Mahasiswa</p>
                                        <img src="{{ url('/mahasiswa/foto/'. $seminar->mahasiswa['foto'] ?? '/') }}" alt="" width="200px">
                                        <br><br>
                                        <address>
                                            <p>Nama</p>
                                            <p class="font-weight-bold">{{ $seminar->mahasiswa['nama'] }}</p><br>
                                            <p>NPM</p>
                                            <p class="font-weight-bold">{{ $seminar->mahasiswa['npm'] }}</p><br>
                                            <p>Angkatan</p>
                                            <p class="font-weight-bold">{{ $seminar->mahasiswa['angkatan'] }}</p><br>
                                            <p>Judul Skripsi</p>
                                            <p class="font-weight-bold">{{ $seminar->judul_skripsi }}</p><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-description">Persyaratan</p>
                                        <div class="row">
                                            @if ($seminar->mahasiswa['program_studi']=='Perencanaan Wilayah dan Kota')
                                            <ul class="list-arrow">
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat01', $seminar->syarat_1) }}" target="_blank">Bukti pembayaran sidang pembahasan</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat02', $seminar->syarat_2) }}" target="_blank">Sertifikat pesantren mahasiswa baru dan sarjana</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat03', $seminar->syarat_3) }}" target="_blank">Transkrip nilai</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat04', $seminar->syarat_4) }}" target="_blank">Sertifikat TOEFL</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat05', $seminar->syarat_5) }}" target="_blank">Bukti bebas pinjaman perpustakaan</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat06', $seminar->syarat_6) }}" target="_blank">Bukti bebas koperasi mahasiswa</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat07', $seminar->syarat_7) }}" target="_blank">Sertifikat SKKFT</a></li>
                                            </ul>

                                            @elseif ($seminar->mahasiswa['program_studi']=='Teknik Industri')

                                            @elseif ($seminar->mahasiswa['program_studi']=='Teknik Pertambangan')
                                            <ul class="list-arrow">
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat01', $seminar->syarat_1) }}" target="_blank">Bukti pembayaran Kolokium Skripsi</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat02', $seminar->syarat_2) }}" target="_blank">Sertifikat TOEFL</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat03', $seminar->syarat_3) }}" target="_blank">Formulir nilai bimbingan skripsi</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat04', $seminar->syarat_4) }}" target="_blank">Formulir kemajuan bimbingan skripsi</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat05', $seminar->syarat_5) }}" target="_blank">Formulir persetujuan kolokium skripsi</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat06', $seminar->syarat_6) }}" target="_blank">Formulir kesediaan menghadiri kolokium skripsi</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat07', $seminar->syarat_7) }}" target="_blank">Pas foto ukuran 4 x 6 sebanyak 2 lembar</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat08', $seminar->syarat_8) }}" target="_blank">Kartu Tanda Mahasiswa</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat09', $seminar->syarat_9) }}" target="_blank">Bukti pembayaran kuliah</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat10', $seminar->syarat_10) }}" target="_blank">Bukti perwalian</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat11', $seminar->syarat_11) }}" target="_blank">Bukti bebas pinjaman perpustakaan</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat12', $seminar->syarat_12) }}" target="_blank">Keterangan menghadiri kolokium skripsi (7 kali)</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat13', $seminar->syarat_13) }}" target="_blank">Draft skripsi (PDF)</a></li>
                                                <li><a href="{{ url('/mahasiswa/seminar/syarat14', $seminar->syarat_14) }}" target="_blank">Draft skripsi (DOCX)</a></li>
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
                                            <option value="2" @if($seminar->status==2) selected @endif>Ditolak</option>
                                            <option value="1" @if($seminar->status==1) selected @endif>Diterima</option>
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
                                        <a href="{{ route('viewDaftarSeminar', 'Perencanaan Wilayah dan Kota') }}" class="btn btn-light">Batal</a>
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