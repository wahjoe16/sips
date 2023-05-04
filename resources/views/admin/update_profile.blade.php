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

                    <form class="" action="{{ route('updateProfileAdmin') }}" method="post" name="updateAdminProfileForm" id="updateAdminProfileForm" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="nik">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" name="nik" class="form-control" id="username" value="{{ Auth::guard('admin')->user()->nik }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="name">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="username" value="{{ Auth::guard('admin')->user()->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="email">E-mail</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="email" value="{{ Auth::guard('admin')->user()->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="mobile">Mobile Phone</label>
                            <div class="col-sm-9">
                                <input type="text" name="mobile" class="form-control" id="mobile" value="{{ Auth::guard('admin')->user()->mobile }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="foto">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" name="foto" class="form-control" id="foto">
                                @if(!empty(Auth::guard('admin')->user()->foto))
                                <a target="_blank" href="{{ url('admin/foto/'.Auth::guard('admin')->user()->foto) }}">Lihat Foto</a>
                                <input type="hidden" name="current_admin_foto" value="{{ Auth::guard('admin')->user()->foto }}">
                                @endif
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