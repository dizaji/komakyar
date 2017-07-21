<?php

use Illuminate\Database\Seeder;

class UsersAdminSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'مدیر وبسایت',
            'family' => '',
            'email' => 'admin@nourinik.ir',
            'password' => \Illuminate\Support\Facades\Hash::make('1234567890'),
            'is_student' => false,
            'is_teacher' => false,
            'is_staff' => true,
            'is_parent' => false,
            'profile_picture' => null,
            'description' => 'مدیر سامانه',
        ]);

        $user->staff()->save(new \App\Models\User\Staff([
            'degree' => null,
            'field_of_study' => '',
            'direct_no' => null,
            'extension' => null,
            'description' => null,
            'is_visible' => false,
        ]));
    }
}
