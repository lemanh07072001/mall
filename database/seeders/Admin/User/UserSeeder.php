<?php

namespace Database\Seeders\Admin\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['name' => "lemanh",'email'=>'manhlaso223@gmail.com','password'=>'$2a$12$y5PQmqiCocU5DBWAZqPMjOctK4y4nK8G/nMQiHsMLcFYN/kP9pzI2']
        ];

        DB::table('users')->insert($data);
    }
}
