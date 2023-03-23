@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tahun Ajaran</h4>
                    <a href="{{ route('addEditTahunAjaran') }}" class="btn btn-success btn-block" style="max-width: 150px; float: right; display:inline-block;">
                        + Data Tahun Ajaran
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
                        <table id="tahun_ajaran" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tahun_ajaran as $ta)
                                <tr>
                                    <td>{{ $ta['id'] }}</td>
                                    <td>{{ $ta['tahun_ajaran'] }}</td>
                                    <td>{{ $ta['semesterx']['semester'] }}</td>
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