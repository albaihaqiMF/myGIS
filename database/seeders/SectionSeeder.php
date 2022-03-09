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
        $json = \Illuminate\Support\Facades\File::get(base_path("database/json/sections.json"));
        $section = json_decode($json);

        foreach ($section as $key => $value) {
            Section::insert([
                'master_id' => $value->master_id,
                'geometry' => $value->geometry,
                'age' => $value->age,
                'variaty' => $value->variaty,
                'crop' => $value->crop,
                'forcing_time' => $value->forcing_time,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ]);
        }
    }
}
