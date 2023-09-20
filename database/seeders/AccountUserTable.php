<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AccountUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'user_name'=>'Hải Đăng',
                'user_address'=>'310 Lý Thường Kiệt, K2, P6, TP Cà Mau',
                'user_phone'=>'0913625637',
                'user_email'=>'dangb1909900@student.ctu.edu.vn',
                'user_password'=>bcrypt('123456'),
            ],
            [
                'user_name'=>'Hải Đăng',
                'user_address'=>'310 Lý Thường Kiệt, K2, P6, TP Cà Mau',
                'user_phone'=>'0913625637',
                'user_email'=>'dangb1909900@student.ctu.edu.vn',
                'user_password'=>bcrypt('123456'),
            ],
        ];
        DB::table('lv_users')->insert($data);
    }
}
