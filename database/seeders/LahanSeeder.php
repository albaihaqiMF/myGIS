<?php

namespace Database\Seeders;

use App\Models\Lahan;
use Illuminate\Database\Seeder;

class LahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'              => 'Jakarta',
            'slug'              => 'jakarta-' . date('ymdHis',strtotime(now())),
            'created_by'        => 2,
            'sw_latitude'       => -6.3914220000000,
            'sw_longitude'      => 106.7028170000000,
            'ne_latitude'       => -6.0926120000000,
            'ne_longitude'      => 106.9670920000000,
            'gambar_taksasi'    => "images/dummy/taksasi.png",
            'gambar_ndvi'       => "images/dummy/ndvi.png",
        ];

        Lahan::create($data);
    }
}
