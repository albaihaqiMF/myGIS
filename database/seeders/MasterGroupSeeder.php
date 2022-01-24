<?php

namespace Database\Seeders;

use App\Models\MasterGroup;
use Illuminate\Database\Seeder;

class MasterGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterGroup::create([
            'id' => '2201010001',
            'name' => 'PG - 1',
            'chief' => '0000000000',
            'pg' => 11,
            'type' => 'PG',
        ]);

        MasterGroup::create([
            'id' => '2201010002',
            'name' => 'WILAYAH - 1',
            'chief' => '0000000000',
            'pg' => 11,
            'area' => 1,
            'type' => 'AREA',
        ]);

        MasterGroup::create([
            'id' => '2201010003',
            'name' => 'LOKASI - 1',
            'chief' => '0000000000',
            'pg' => 11,
            'area' => 1,
            'location' => 1,
            'type' => 'LOC',
        ]);

        MasterGroup::create([
            'id' => '2201010004',
            'name' => 'SEKSI - 1',
            'chief' => '0000000000',
            'pg' => 11,
            'area' => 1,
            'location' => 1,
            'section' => 1,
            'type' => 'SEC',
        ]);

        MasterGroup::create([
            'id' => '2201010005',
            'name' => 'PLOT - 1',
            'chief' => '0000000000',
            'pg' => 11,
            'area' => 1,
            'location' => 1,
            'section' => 1,
            'plot' => 1,
            'type' => 'PLOT',
        ]);
    }
}
