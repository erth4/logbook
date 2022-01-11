<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();
        
        Status::create([
            'id'    => 1,
            'name'  => 'Logbook Minggu 1 sd 7 (sebelum UTS)'
        ]);

        Status::create([
            'id'    => 2,
            'name'  => 'Logbook Minggu 8 sd 12 (setelah UTS)'
        ]);
    }
}
