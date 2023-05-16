@extends('dosen.layout.layout')
@push('css')
<style>

</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <div class="btn-group">
                        <button onclick="filter()" class="btn btn-outline-info"><i class="mdi mdi-filter"></i>Filter</button>
                        <a href="#" class="btn btn-outline-success"><i class="mdi mdi-file-excel-box">Export XLS</i></a>
                        <a href="#" class="btn btn-outline-danger"><i class="mdi mdi-file-pdf-box">Export PDF</i></a>
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

                    @if($slug=="Teknik Pertambangan")
                    <div class="table-responsive pt-3">
                        <table class="table table-striped table-rekap-sidang">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @endif

                    @if($slug=="Teknik Industri")
                    <div class="table-responsive pt-3">
                        <table class="table table-striped table-rekap-sidang">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @endif

                    @if($slug=="Perencanaan Wilayah dan Kota")
                    <div class="table-responsive pt-3">
                        <table class="table table-striped table-rekap-sidang">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@includeIf('dosen.form')
@push('scripts')
<script>
    let table;
    let tahun_ajaran_id = $('#tahun_ajaran_id').val();

    $(function() {
        table = $('.table-rekap-sidang').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('daftar-sidang.data', ['slug'=>'Teknik Pertambangan', 'slug'=>'Teknik Industri', 'slug'=>'Perencanaan Wilayah dan Kota']) }}",
                type: "GET",
                data: function(d) {
                    d.tahun_ajaran_id = tahun_ajaran_id;
                    return d;
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'npm',
                },
                {
                    data: 'nama',
                },
                {
                    data: 'program_studi'
                },
                {
                    data: 'tahun_ajaran',
                },
                {
                    data: 'aksi',
                },
            ]
        });


    });

    function filter() {
        $('#modal-form').modal('show');
    }

    $(".filter").on('change', function() {
        tahun_ajaran_id = $('#tahun_ajaran_id').val();
        table.ajax.reload(null, false);
    })
</script>

@endpush