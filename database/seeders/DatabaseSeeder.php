<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            // UserSeeder::class,

            // MasterGroupSeeder::class,

            // PlantationGroupSeeder::class,
            // AreaSeeder::class,
            // LocationSeeder::class,
            // SectionSeeder::class,
            // PlotSeeder::class,
        ]);
    }
}
