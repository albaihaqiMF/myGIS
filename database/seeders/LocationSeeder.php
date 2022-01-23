<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'id' => '00010002',
            'area_id' => '00000001', // the 3 first digit is belongs to id of PlantationGroup
            'pg_id' => '0000',
            'name' => 'W-Test',
            'chief' => '0000000000'
        ]);
    }
}
