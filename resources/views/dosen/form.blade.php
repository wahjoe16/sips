<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('daftar-seminar.index', ['slug'=>'Teknik Pertambangan', 'slug'=>'Teknik industri', 'slug'=>'Perencanaan Wilayah dan Kota']) }}" method="post" data-toggle="validator" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="tahun_ajaran_id">Periode</label>
                            <div class="col-sm-9">
                                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control text-dark filter">
                                    <option value="">Pilih</option>
                                    @foreach($tahun_ajaran as $ta)
                                    <option value="{{ $ta['id'] }}">{{ $ta['tahun_ajaran'] }} / {{ $ta['semesterx']['semester'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label" for="program_studi">Program Studi</label>
                            <div class="col-sm-9">
                                <select name="program_studi" id="program_studi" class="form-control text-dark">
                                    <option value="">Pilih</option>
                                    @foreach ([
                                    "Teknik Pertambangan"=>"Teknik Pertambangan",
                                    "Perencanaan Wilayah dan Kota"=>"Perencanaan Wilayah dan Kota",
                                    "Teknik Industri"=>"Teknik Industri"
                                    ] as $programStudi => $prodiLabel)
                                    <option value="{{ $programStudi }}">{{ $prodiLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </form>
    </div>
</div>