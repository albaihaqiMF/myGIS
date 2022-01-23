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
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ];
        $user = [
            'id' => '2112091002',
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ];
        User::create($admin);
        User::create($user);
        User::create([
            'id' => '0000000000',
            'name' => 'Super',
            'username' => 'super',
            'email' => 'super@example.com',
            'password' => bcrypt('passwordsuper'),
            'role_id' => 1
        ]);
    }
}
