<?php

namespace Database\Seeders;

use App\Models\PlantationGroup;
use Illuminate\Database\Seeder;

class PlantationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantationGroup::create([
            'id' => '0000',
            'name' => 'PG-Test',
            'chief' => '0000000000'
        ]);
    }
}