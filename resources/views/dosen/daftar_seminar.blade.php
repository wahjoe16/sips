@extends('dosen.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
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

                    @if($slug == 'Teknik Pertambangan')
                    <div class="table-responsive pt-3">
                        <table id="daftarSeminarMahasiswa" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Judul Skripsi</th>
                                    <th>Approve</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarSeminar as $ds)
                                <tr>
                                    <td>{{ $ds['id'] }}</td>
                                    <td>{{ $ds['mahasiswaNPM']['npm'] }}</td>
                                    <td>{{ $ds['mahasiswaNama']['nama'] }}</td>
                                    <td>{{ $ds['judul_skripsi'] }}</td>
                                    <td>
                                        <a href="{{ route('showDaftarSeminar', $ds['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if($slug == 'Teknik Industri')
                    <div class="table-responsive pt-3">
                        <table id="daftarSeminarMahasiswa" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Judul Skripsi</th>
                                    <th>Approve</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarSidang as $ds)
                                <tr>
                                    <td>{{ $ds['id'] }}</td>
                                    <td>{{ $ds['mahasiswaNPM']['npm'] }}</td>
                                    <td>{{ $ds['mahasiswaNama']['nama'] }}</td>
                                    <td>{{ $ds['judul_skripsi'] }}</td>
                                    <td>
                                        <a href="{{ route('showDaftarSeminar', $ds['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if($slug == 'Perencanaan Wilayah dan Kota')
                    <div class="table-responsive pt-3">
                        <table id="daftarSeminarMahasiswa" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Approve</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarSeminar as $ds)
                                <tr>
                                    <td>{{ $ds['id'] }}</td>
                                    <td>{{ $ds['mahasiswaNPM']['npm'] }}</td>
                                    <td>{{ $ds['mahasiswaNama']['nama'] }}</td>
                                    <td>
                                        <a href="{{ route('showDaftarSeminar', $ds['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection