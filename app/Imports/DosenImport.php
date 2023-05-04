<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DosenImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Dosen([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'program_studi' => $row['program_studi'],
            'tipe' => $row['tipe'],
            'password' => bcrypt($row['nik']),
        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|unique:dosens',
            'nama' => 'required',
            'program_studi' => 'required',
            'tipe' => 'required'
        ];
    }
}
