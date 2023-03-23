@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dosen</h4>
                    <a href="{{ route('addEditDosen') }}" class="btn btn-success btn-block" style="max-width: 150px; float: right; display:inline-block;">
                        + Data Dosen
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
                        <table id="dosen" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dosen as $d)
                                <tr>
                                    <td>{{ $d['id'] }}</td>
                                    <td>{{ $d['nik'] }}</td>
                                    <td>{{ $d['nama'] }}</td>
                                    <td>{{ $d['program_studi'] }}</td>
                                    <td>{{ $d['tipe'] }}</td>
                                    <td>
                                        <a href="{{ route('addEditDosen', $d['id']) }}">
                                            <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="confirm-delete" module="dosen" module_id="{{ $d['id'] }}" module_name="{{ $d['nama'] }}">
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