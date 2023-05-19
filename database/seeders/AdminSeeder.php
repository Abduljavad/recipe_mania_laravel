<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::firstOrcreate(
            ['name' => 'super_admin'],
            [
                'password' => bcrypt('password'),
                'email' => 'admin@minnalapp.com',
            ]
        );
        $super_admin->assignRole('super_admin');
    }
}
