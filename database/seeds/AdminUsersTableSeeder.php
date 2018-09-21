<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'username'  =>  'admin',
            'password'  =>  bcrypt('123456'),
            'name'  =>  '惠麦客',
        ]);
    }
}
