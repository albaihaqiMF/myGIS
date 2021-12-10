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
        $cinta_manis = [
            'id' => '2112093001',
            'name' => 'Cinta Manis'
        ];

        $bunga_mayang = [
            'id' => '2112093002',
            'name' => 'Bunga Mayang'
        ];

        Area::create($cinta_manis);
        Area::create($bunga_mayang);
    }
}
