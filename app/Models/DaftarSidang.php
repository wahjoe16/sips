<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarSidang extends Model
{
    use HasFactory;
    protected $table = 'daftar_sidang';
    protected $fillable = ['status', 'keterangan'];

    public function dosen_1()
    {
        return $this->belongsTo(Dosen::class, 'dosen1_id', 'id');
    }

    public function dosen_2()
    {
        return $this->belongsTo(Dosen::class, 'dosen2_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
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
