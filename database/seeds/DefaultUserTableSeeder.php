<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
                'email'      => 'suadmin@getnerdify.com',
                'name'       => 'SuperUser Admin',
                'password'   => bcrypt('cupboard'),
                'type'       => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'email'      => 'samuel@getnerdify.com',
                'name'       => 'Samuel Gutierrez',
                'password'   => bcrypt('321321'),
                'type'       => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
