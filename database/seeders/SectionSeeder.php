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
            'master_id'         => '2201010004',
            'sw_latitude'       => -6.3914220000000,
            'sw_longitude'      => 106.7028170000000,
            'ne_latitude'       => -6.0926120000000,
            'ne_longitude'      => 106.9670920000000,
            'age'               => '2021-12-05',
            'variaty'           => 'Variaty 1',
            'crop'              => 'second',
            'forcing_time'      => 2,
            'gambar_taksasi'    => "images/dummy/taksasi.png",
            'gambar_ndvi'       => "images/dummy/ndvi.png",
            'geometry'          => json_encode([
                'type' => "FeatureCollection",
                'features' => array(),
            ]),
        ];

        Section::create($data);
    }
}
