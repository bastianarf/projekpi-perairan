<?php

use App\Models\Uang_harian;
use Illuminate\Database\Seeder;

class UangharianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uangharian = collect([
            [
                'nama'        => 'Nama Admin',
                'role'        => 'Admin',
                'uang_harian' => '100000'
            ],
            [
                'nama'        => 'Nama Kepala Bidang',
                'role'        => 'Kepala Bidang',
                'uang_harian' => '500000'
            ],
            [
                'nama'        => 'Nama Staff',
                'role'        => 'Staff',
                'uang_harian' => '400000'
            ],
            [
                'nama'        => 'Nama Kepala Seksi',
                'role'        => 'Kepala Seksi',
                'uang_harian' => '300000'
            ],
            [
                'nama'        => 'Nama Sekretaris Bidang',
                'role'        => 'Sekretaris Bidang',
                'uang_harian' => '350000'
            ]
        ]);

        $uangharian->each(function($data){
            Uang_harian::create([
                'nama'        => $data['nama'],
                'role'        => $data['role'],
                'uang_harian' => $data['uang_harian']
            ]);
        });

    }
}
