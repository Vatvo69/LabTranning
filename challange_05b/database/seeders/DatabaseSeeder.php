<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert(['username'=>'teacher1','password'=>bcrypt('123456a@A'),'fullname'=>'Le Duc A','email'=>'a@gmail.com','phone'=>'0123456789','imagePath'=>NULL,'role'=>1]);
       DB::table('users')->insert(['username'=>'teacher2','password'=>bcrypt('123456a@A'),'fullname'=>'Le Duc B','email'=>'b@gmail.com','phone'=>'0123456789','imagePath'=>NULL,'role'=>1]);
       DB::table('users')->insert(['username'=>'student1','password'=>bcrypt('123456a@A'),'fullname'=>'Le Duc C','email'=>'c@gmail.com','phone'=>'0123456789','imagePath'=>NULL,'role'=>0]);
       DB::table('users')->insert(['username'=>'student2','password'=>bcrypt('123456a@A'),'fullname'=>'Le Duc D','email'=>'d@gmail.com','phone'=>'0123456789','imagePath'=>NULL,'role'=>0]);
    }
}
