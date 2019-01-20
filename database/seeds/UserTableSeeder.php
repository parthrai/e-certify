<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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

            'name'=>'admin',
            'email'=>'admin@admin.com',
            'is_admin'=>true,
            'account_status'=>true,
            'password'=> bcrypt("testpass")
        ]);



    }
}
