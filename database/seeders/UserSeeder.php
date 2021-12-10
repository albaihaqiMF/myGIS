<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'id' => '2112091001',
            'area_id' => '2112093002',
            'name' => 'Admin BM',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ];
        $admin2 = [
            'id' => '2112091003',
            'area_id' => '2112093001',
            'name' => 'Admin CM',
            'username' => 'admin2',
            'email' => 'admin2@admin.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ];
        $user_bm = [
            'id' => '2112091002',
            'area_id' => '2112093002',
            'name' => 'User Bunga Mayang',
            'username' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ];
        $user_cm = [
            'id' => '2112091004',
            'area_id' => '2112093001',
            'name' => 'User Cinta Manis',
            'username' => 'user_cm',
            'email' => 'user2@user.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ];
        User::create($admin);
        User::create($admin2);
        User::create($user_bm);
        User::create($user_cm);
    }
}
