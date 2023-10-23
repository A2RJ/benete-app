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
                'id' => 8,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Administrtor hanya dapat mengelola akun user',
                'created_at' => '2023-10-21 17:17:15',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            1 => 
            array (
                'id' => 9,
                'name' => 'bidang keuangan',
                'display_name' => 'Bidang Keuangan',
                'description' => 'User ini hanya dapat mengelola bidang keuangan',
                'created_at' => '2023-10-21 17:17:15',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            2 => 
            array (
                'id' => 10,
                'name' => 'bidang kesyahbandaran',
                'display_name' => 'Bidang Kesyahbandaran',
                'description' => 'User ini hanya dapat mengelola bidang kesyahbandaran',
                'created_at' => '2023-10-21 17:17:15',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            3 => 
            array (
                'id' => 11,
                'name' => 'bidang pengelola bmn dan persediaan',
                'display_name' => 'Bidang Pengelola BMN dan Persediaan',
                'description' => 'User ini hanya dapat mengelola bidang pengelola bmn dan persediaan',
                'created_at' => '2023-10-21 17:17:15',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            4 => 
            array (
                'id' => 12,
                'name' => 'bidang kepegawaian atau tata usaha',
                'display_name' => 'Bidang Kepegawaian atau Tata Usaha',
                'description' => 'User ini hanya dapat mengelola bidang kepegawaian atau tata usaha',
                'created_at' => '2023-10-21 17:17:15',
                'updated_at' => '2023-10-21 17:17:15',
            ),
            5 => 
            array (
                'id' => 13,
                'name' => 'bidang kepelabuhan',
                'display_name' => 'Bidang Kepelabuhan',
                'description' => 'User ini hanya dapat mengelola bidang kepelabuhan',
                'created_at' => '2023-10-21 17:17:15',
                'updated_at' => '2023-10-21 17:17:15',
            ),
        ));
        
        
    }
}