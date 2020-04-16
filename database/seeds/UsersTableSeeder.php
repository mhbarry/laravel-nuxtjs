<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('password');
        $items = [
            [
                'fullname' => 'Admin Admin',
                'email' => 'admin@admin.com',
                'password' => $password
            ],
            [
                'fullname' => 'User User',
                'email' => 'user@user.com',
                'password' => $password
            ]
        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
