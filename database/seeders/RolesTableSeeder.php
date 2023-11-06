<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'created_at' => '2023-10-21 17:17:15',
                'description' => 'Administrtor hanya dapat mengelola akun user',
                'display_name' => 'Administrator',
                'id' => 8,
                'name' => 'admin',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            1 => 
            array (
                'created_at' => '2023-10-21 17:17:15',
                'description' => 'User ini hanya dapat mengelola bidang keuangan',
                'display_name' => 'Bidang Keuangan',
                'id' => 9,
                'name' => 'bidang keuangan',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            2 => 
            array (
                'created_at' => '2023-10-21 17:17:15',
                'description' => 'User ini hanya dapat mengelola bidang kesyahbandaran',
                'display_name' => 'Bidang Kesyahbandaran',
                'id' => 10,
                'name' => 'bidang kesyahbandaran',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            3 => 
            array (
                'created_at' => '2023-10-21 17:17:15',
                'description' => 'User ini hanya dapat mengelola bidang pengelola bmn dan persediaan',
                'display_name' => 'Bidang Pengelola BMN dan Persediaan',
                'id' => 11,
                'name' => 'bidang pengelola bmn dan persediaan',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            4 => 
            array (
                'created_at' => '2023-10-21 17:17:15',
                'description' => 'User ini hanya dapat mengelola bidang kepegawaian atau tata usaha',
                'display_name' => 'Bidang Kepegawaian atau Tata Usaha',
                'id' => 12,
                'name' => 'bidang kepegawaian atau tata usaha',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            5 => 
            array (
                'created_at' => '2023-10-21 17:17:15',
                'description' => 'User ini hanya dapat mengelola bidang kepelabuhan',
                'display_name' => 'Bidang Kepelabuhan',
                'id' => 13,
                'name' => 'bidang kepelabuhan',
                'updated_at' => '2023-10-21 17:17:15',
            ),
        ));
        
        
    }
}