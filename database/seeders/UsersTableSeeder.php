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
                'created_at' => '2023-10-20 17:09:29',
                'deleted_at' => NULL,
                'email' => 'admin@mail.com',
                'email_verified_at' => '2023-10-20 17:09:29',
                'id' => 1,
                'name' => 'Admin',
                'password' => '$2y$10$Do2uJLG/j7RBcZd.dpMImuYyKufanV/L16D.biD4sDd8GaKs2NTBS',
                'remember_token' => 'WMpUqDzC1V98P69wEZjERN8Yu996pBMfSjvMcxC3D111NPtuUnME6qn4p0qH',
                'updated_at' => '2023-10-20 17:09:29',
                'whatsapp' => '8759387593',
            ),
            1 =>
            array(
                'created_at' => '2023-10-25 17:09:33',
                'deleted_at' => NULL,
                'email' => 'keuangan@mail.com',
                'email_verified_at' => NULL,
                'id' => 2,
                'name' => 'Admin Keuangan',
                'password' => '$2y$10$YRwyDo.K.qJMj1QIcZHcz.RtzxT8y8oJKH3akcEk2WzaRkM5JBxk2',
                'remember_token' => NULL,
                'updated_at' => '2023-10-31 10:37:55',
                'whatsapp' => '69845864',
            ),
            2 =>
            array(
                'created_at' => '2023-10-31 10:37:35',
                'deleted_at' => NULL,
                'email' => 'kesyahbandaran@mail.com',
                'email_verified_at' => NULL,
                'id' => 3,
                'name' => 'Admin Kesyahbandaran',
                'password' => '$2y$10$MRYv7SrsjUmJFeXhDojiQurLiQSX.mZeWNTyDdRHzZb4mFKIpUUIO',
                'remember_token' => NULL,
                'updated_at' => '2023-10-31 10:37:35',
                'whatsapp' => '67868768',
            ),
            3 =>
            array(
                'created_at' => '2023-10-31 10:38:40',
                'deleted_at' => NULL,
                'email' => 'bmn@mail.com',
                'email_verified_at' => NULL,
                'id' => 4,
                'name' => 'Admin BMN dan Persediaan',
                'password' => '$2y$10$jS4jikWIk8p4zIi2sUx4ResHszs6ygdaAfVTKF0izXHeOuCG6gs0.',
                'remember_token' => NULL,
                'updated_at' => '2023-10-31 10:38:40',
                'whatsapp' => '984593485',
            ),
            4 =>
            array(
                'created_at' => '2023-10-31 10:39:33',
                'deleted_at' => NULL,
                'email' => 'tu@mail.com',
                'email_verified_at' => NULL,
                'id' => 5,
                'name' => 'Admin Kepegawaian dan TU',
                'password' => '$2y$10$LpH7rSpsZRQaoJkMUxZ.2OlUku9Zlue7IzQASUfVojyO3Dv.PFNSO',
                'remember_token' => NULL,
                'updated_at' => '2023-10-31 10:39:33',
                'whatsapp' => '879879',
            ),
            5 =>
            array(
                'created_at' => '2023-10-31 10:40:12',
                'deleted_at' => NULL,
                'email' => 'kepelabuhan@mail.com',
                'email_verified_at' => NULL,
                'id' => 6,
                'name' => 'Admin Kepelabuhan',
                'password' => '$2y$10$SDMW5n.TtL0YagRfou7ZYuhQPECGquPQKrolKAfWHVJ7VIxR8ma2W',
                'remember_token' => NULL,
                'updated_at' => '2023-10-31 10:40:12',
                'whatsapp' => '658676787',
            ),
        ));
        
        
    }
}