<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
        	"name" => str_random(10),
        	"email" => str_random(10)."@qq.com",
        	"password" => bcrypt('zzjadmin');
        ]);
    }
}
