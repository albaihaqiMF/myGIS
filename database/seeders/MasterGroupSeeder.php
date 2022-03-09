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
        $json = \Illuminate\Support\Facades\File::get(base_path("database/json/master_groups.json"));
        $masterGroup = json_decode($json);

        foreach ($masterGroup as $key => $value) {
            MasterGroup::insert([
                'id' => $value->id,
                'name' => $value->name,
                'chief' => $value->chief,
                'pg' => $value->pg,
                'area' => $value->area,
                'location' => $value->location,
                'section' => $value->section,
                'plot' => $value->plot,
                'type' => $value->type,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ]);
        }

    }
}
