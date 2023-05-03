<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            [
                'id' => 1,
                'nik' => 'A190436',
                'name' => 'Wahyu',
                'type' => 'admin',
                'email' => 'wahjoe16@gmail.com',
                'mobile' => '082240312828',
                'password' => '$2a$12$//4i16Wnq0Zw/YjinPM3teqgpH9QHTcqFrvUmMEuCQg4JAIExdhym',
                'status' => 1,
                'foto' => '',
            ]
        ];

        Admin::insert($adminRecords);
    }
}
