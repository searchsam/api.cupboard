<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DefaultUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'SuperUser Admin',
                'email' => 'suadmin@getnerdify.com',
                'password' => bcrypt('cupboard'),
                'type' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Samuel Gutierrez',
                'email' => 'samuel@getnerdify.com',
                'password' => bcrypt('321321'),
                'type' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
