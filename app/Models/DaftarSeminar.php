<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarSeminar extends Model
{
    use HasFactory;
    protected $table = 'daftar_seminar';
    protected $fillable = ['status', 'keterangan'];

    public function dosen_1()
    {
        return $this->belongsTo(Dosen::class, 'dosen1_id')->select('id', 'semester');
    }

    public function dosen_2()
    {
        return $this->belongsTo(Dosen::class, 'dosen2_id')->select('id', 'nama');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

    public function mahasiswaNama()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id')->select('id', 'nama');
    }

    public function mahasiswaNPM()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id')->select('id', 'npm');
    }
}
