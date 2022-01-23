<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'id'                => '00020003',
            'location_id'       => '00010002',
            'area_id'           => '00000001', // the 3 first digit is belongs to id of PlantationGroup
            'pg_id'             => '0000',
            'name'              => 'Jakarta',
            'chief'             => '0000000000',
            'created_by'             => '0000000000',
            'sw_latitude'       => -6.3914220000000,
            'sw_longitude'      => 106.7028170000000,
            'ne_latitude'       => -6.0926120000000,
            'ne_longitude'      => 106.9670920000000,
            'gambar_taksasi'    => "images/dummy/taksasi.png",
            'gambar_ndvi'       => "images/dummy/ndvi.png",
        ];

        Section::create($data);
    }
}
