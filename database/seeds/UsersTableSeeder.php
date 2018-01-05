<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds to seed the admin user.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Doe',
            'email' => 'admin@example.org',
            'password' => bcrypt('test1234'),
        ]);
    }
}
