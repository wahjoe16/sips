<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = ['npm', 'nama', 'password'];

    public function getFotoPathAttribute()
    {
        if ($this->foto != '') {
            return url('/mahasiswa/foto/' . $this->foto);
        } else {
            return 'http://placehold.it/850x618';
        }
    }
}
