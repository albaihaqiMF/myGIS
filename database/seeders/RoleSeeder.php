<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [

            [
                'id' => 0,
                'title' => 'SUPER'
            ],
            [
                'id' => 1,
                'title' => 'ADMIN',
            ],
            [
                'id' => 2,
                'title' => 'USER'
            ],

        ];
        Role::insert($roles);
    }
}
