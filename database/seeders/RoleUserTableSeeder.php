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
                'role_id' => 13,
                'user_id' => 2,
                'user_type' => 'App\\Models\\User',
            ),
        ));
        
        
    }
}