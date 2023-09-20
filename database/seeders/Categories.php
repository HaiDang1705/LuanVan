<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Categories extends Seeder
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
                'cate_name'=>'Nước sơn',
                'cate_slug'=>str::slug('Nước sơn')
            ],
            [
                'cate_name'=>'Bột trét tường',
                'cate_slug'=>str::slug('Bột trét tường')
            ],
        ];
        DB::table('lv_category')->insert($data);
    }
}
