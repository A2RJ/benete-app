<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->createMany([
        //     [
        //         'name' => 'Super Admin',
        //         'email' => 'test@mail.com',
        //         'bidang' => 'admin',
        //         'password' => Hash::make('testtest')
        //     ],
        //     [
        //         'name' => 'Bidang Keuangan',
        //         'email' => 'keuangan@mail.com',
        //         'bidang' => 'bidang keuangan',
        //         'password' => Hash::make('keuangan')
        //     ]
        // ]);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
    }
}
