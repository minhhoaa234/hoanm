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
        //
        DB::table('users')->insert([
            'FullName' => 'Admin',
            'email' => 'minhhoa234'.'@gmail.com',
            'password' => bcrypt('123456'),
            'isAdmin'   =>  1,
        ]);
    }
}
