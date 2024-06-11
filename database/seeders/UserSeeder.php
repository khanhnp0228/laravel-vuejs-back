<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "username" => "admin",
                "name" => "Admin",
                "email" => "admin@localhost",
                "password" => Hash::make("admin"),
                "department_id" => "1",
                "status_id" => "1"
            ], [
                "username" => "client",
                "name" => "Client",
                "email" => "client@localhost",
                "password" => Hash::make("client"),
                "department_id" => "2",
                "status_id" => "2"
            ]
        ]);
    }
}
