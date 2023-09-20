<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QTVTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data =
            [
                [
                    'email' => 'dangb1909900@student.ctu.edu.vn',
                    'password' => bcrypt('123456'),
                    'name'=>'Hải Đăng',
                    'level' => 1
                ],
                [
                    'email' => 'dangnguyen1705@gmail.com',
                    'password' => bcrypt('123456'),
                    'name'=>'Hải Đăng',
                    'level' => 2
                ],
            ];
        DB::table('db_qtvs')->insert($data);
    }
}
