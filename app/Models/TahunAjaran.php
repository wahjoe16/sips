<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajaran';

    public function semesterx()
    {
        return $this->belongsTo(Semester::class, 'semester_id')->select('id', 'semester');
    }
}
