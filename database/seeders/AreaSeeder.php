<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'id' => '00000001', // the 3 first digit is belongs to id of PlantationGroup
            'pg_id' => '0000',
            'name' => 'W-Test',
            'chief' => '0000000000'
        ]);
    }
}
