@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Update Profile</h3>
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

                    <form class="" action="{{ route('updatePasswordAdmin') }}" method="post">@csrf
                        <div class="form-group row">
                            <label for="old_password" class="col-lg-2 control-label">Password Lama</label>
                            <div class="col-lg-6">
                                <input type="password" name="old_password" id="old_password" class="form-control" minlength="6">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-6">
                                <input type="password" name="password" id="password" class="form-control" minlength="6">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-lg-2 control-label">Konfirmasi Password</label>
                            <div class="col-lg-6">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" data-match="#password">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('dashboardAdmin') }}" class="btn btn-light">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection