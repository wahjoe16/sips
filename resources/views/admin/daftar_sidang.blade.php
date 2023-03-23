@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Sidang Mahasiswa</h4>

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

                    <div class="table-responsive pt-3">
                        <table id="daftarSidangMahasiswa" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Judul Skripsi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewDatarSidang as $vds)
                                <tr>
                                    <td>{{ $vds['id'] }}</td>
                                    <td>{{ $vds['mahasiswaNPM']['npm'] }}</td>
                                    <td>{{ $vds['mahasiswaNama']['nama'] }}</td>
                                    <td>{{ $vds['program_studi'] }}</td>
                                    <td>{{ $vds['judul_skripsi'] }}</td>
                                    @if($vds['status']==0)
                                    <td class="text-warning">Menunggu Approval</td>
                                    @elseif ($vds['status']==1)
                                    <td class="text-success">Disetujui</td>
                                    @elseif ($vds['status']==2)
                                    <td class="text-danger">Ditolak</td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection