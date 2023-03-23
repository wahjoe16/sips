@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mahasiswa</h4>
                    <a href="{{ route('addEditMahasiswa') }}" class="btn btn-success btn-block" style="max-width: 150px; float: right; display:inline-block;">
                        + Data Mahasiswa
                    </a>
                    <a href="{{ route('importMahasiswa') }}" class="btn btn-success btn-block" style="max-width: 150px; float: right; display:inline-block;">
                        Import Data Mahasiswa
                    </a>
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
                        <table id="mahasiswa" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Angkatan</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $m)
                                <tr>
                                    <td>{{ $m['id'] }}</td>
                                    <td>{{ $m['npm'] }}</td>
                                    <td>{{ $m['nama'] }}</td>
                                    <td>{{ $m['program_studi'] }}</td>
                                    <td>{{ $m['angkatan'] }}</td>
                                    <td>{{ $m['email'] }}</td>
                                    <td>
                                        <a href="{{ route('addEditMahasiswa', $m['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="confirm-delete" module="mahasiswa" module_id="{{ $m['id'] }}" module_name="{{ $m['nama'] }}">
                                            <i class="mdi mdi-delete" style="font-size: 25px;"></i>
                                        </a>
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
</div>
@endsection