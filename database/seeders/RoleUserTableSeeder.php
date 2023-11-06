<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_user')->delete();
        
        \DB::table('role_user')->insert(array (
            0 => 
            array (
                'role_id' => 8,
                'user_id' => 1,
                'user_type' => 'App\\Models\\User',
            ),
            1 => 
            array (
                'role_id' => 9,
                'user_id' => 2,
                'user_type' => 'App\\Models\\User',
            ),
            2 => 
            array (
                'role_id' => 10,
                'user_id' => 3,
                'user_type' => 'App\\Models\\User',
            ),
            3 => 
            array (
                'role_id' => 11,
                'user_id' => 4,
                'user_type' => 'App\\Models\\User',
            ),
            4 => 
            array (
                'role_id' => 12,
                'user_id' => 5,
                'user_type' => 'App\\Models\\User',
            ),
            5 => 
            array (
                'role_id' => 13,
                'user_id' => 6,
                'user_type' => 'App\\Models\\User',
            ),
        ));
        
        
    }
}