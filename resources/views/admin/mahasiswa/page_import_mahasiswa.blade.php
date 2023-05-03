@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Import Data Mahasiswa</h4>
                    <div class="btn-group">
                        <a href="{{ url('/file sample.xlsx') }}" class="btn btn-link">
                            Download Sample File
                        </a>
                    </div>
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

                    @if (session()->has('failures'))
                    <table class="table table-danger">
                        <tr>
                            <th>Baris</th>
                            <th>Attributes</th>
                            <th>Error</th>
                            <th>Value</th>
                        </tr>
                        @foreach (session()->get('failures') as $validasi)
                        <tr>
                            <td>{{ $validasi->row() }}</td>
                            <td>{{ $validasi->attribute() }}</td>
                            <td>
                                <ul>
                                    @foreach ($validasi->errors() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $validasi->values()[$validasi->attribute()] }}</td>
                        </tr>
                        @endforeach
                    </table>
                    @endif

                    <br><br>
                    <form class="form-sample" action="{{ route('importMahasiswa') }}" method="post" name="addEditMahasiswatForm" id="addEditMahasiswatForm" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="file">File</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="file" class="form-control" id="file">
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('viewMahasiswa') }}" class="btn btn-light">Batal</a>
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