<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ColorProduct extends Seeder
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
                'color_name'=>'Không',
                'color_slug'=>str::slug('Không')
            ],
            [
                'color_name'=>'Đỏ',
                'color_slug'=>str::slug('Đỏ')
            ],
            [
                'color_name'=>'Vàng',
                'color_slug'=>str::slug('Vàng')
            ],
        ];
        DB::table('lv_colorproduct')->insert($data);
    }
}
