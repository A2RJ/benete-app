<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
            array(
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'whatsapp' => '8759387593',
                'email_verified_at' => '2023-10-20 17:09:29',
                'password' => '$2y$10$Do2uJLG/j7RBcZd.dpMImuYyKufanV/L16D.biD4sDd8GaKs2NTBS',
                'remember_token' => 'jbCJdkuoewvxetIAJhWsfZaWUFwLvCSrNkbl9wR5QVG0vjSXhjxzjxd4U9vT',
                'created_at' => '2023-10-20 17:09:29',
                'updated_at' => '2023-10-20 17:09:29',
            ),
            1 =>
            array(
                'name' => 'Admin Keuangan CKCKCK',
                'email' => 'keuangan@mail.com',
                'whatsapp' => '69845864',
                'email_verified_at' => NULL,
                'password' => '$2y$10$loPMspshxUNbYtUFiuwSlOKrDClmJ1fylcyau2H1GcPnvlsD37GAW',
                'remember_token' => NULL,
                'created_at' => '2023-10-20 17:09:33',
                'updated_at' => '2023-10-20 17:28:12',
            ),
        ));
    }
}
