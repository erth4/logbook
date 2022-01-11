<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Roles::truncate();

        Roles::create([
            'id'    => 1,
            'name'  => 'Mahasiswa'
        ]);

        Roles::create([
            'id'    => 2,
            'name'  => 'Dosen Pembimbing KP'
        ]);

        Roles::create([
            'id'    => 3,
            'name'  => 'Dosen Pengampu Kelas KP'
        ]);

        Roles::create([
            'id'    => 4,
            'name'  => 'Pembimbing Lapangan'
        ]);

        Roles::create([
            'id'    => 99,
            'name'  => 'Super Admin'
        ]);
    }
}
