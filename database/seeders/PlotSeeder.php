<?php

namespace Database\Seeders;

use App\Models\Plot;
use Illuminate\Database\Seeder;

class PlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plot::create(['master_id' => '2201010004',]);
    }
}
