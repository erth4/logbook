<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        User::create([
            'name'      => 'Ertha Dwi Setiyawan',
            'email'     => 'ertha.setiyawan@gmail.com',
            'identity_number' => Str::random(10),
            'role'      => 1,
            'email_verified_at' => now(),
            'password'  => bcrypt('tempe')
        ]);

        User::create([
            'name'      => 'Jefree Fahana S.T, M.Kom',
            'email'     => 'dosen@gmail.com',
            'identity_number' => Str::random(10),
            'role'      => 2,
            'password'  => bcrypt('password')
        ]);

        User::create([
            'name'      => 'Muhammad Halim Dirgantara, S.Kom',
            'email'     => 'pemlap@gmail.com',
            'identity_number' => Str::random(10),
            'role'      => 4,
            'password'  => bcrypt('password')
        ]);
    }
}
