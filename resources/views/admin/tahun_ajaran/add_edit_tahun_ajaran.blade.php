@extends('admin.layout.layout')
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

                    <form class="form-sample" @if(empty($tahun_ajaran['id'])) action="{{ route('addEditTahunAjaran') }}" @else action="{{ route('addEditTahunAjaran', $semester['id']) }}" @endif method="post" name="addEditTahunAjaranForm" id="addEditTahunAjaranForm">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="npm">Tahun Ajaran</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tahun_ajaran" class="form-control" id="npm" @if(!empty($tahun_ajaran['id'])) value="{{ $tahun_ajaran['tahun_ajaran'] }}" @else value="{{ old('tahun_ajaran') }}" @endif placeholder="Tahun Ajaran">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="npm">Semester</label>
                                    <div class="col-sm-9">
                                        <select name="semester_id" id="semester_id" class="form-control text-dark">
                                            <option value="">Select</option>
                                            @foreach($semester as $s)
                                            <option value="{{ $s['id'] }}">{{ $s['semester'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('viewSemester') }}" class="btn btn-light">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection