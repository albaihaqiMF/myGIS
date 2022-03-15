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
        $json = \Illuminate\Support\Facades\File::get(base_path("database/json/plantation_groups.json"));
        $pg = json_decode($json);

        foreach ($pg as $key => $value) {
            PlantationGroup::create([
                'master_id' => $value->master_id,
                'detail' => $value->detail,
                'geometry' => $value->geometry,
            ]);
        }
    }
}
