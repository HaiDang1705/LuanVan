<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'type_name'=>'Nội thất',
                'type_slug'=>str::slug('Nội thất')
            ],
            [
                'type_name'=>'Ngoại Thất',
                'type_slug'=>str::slug('Ngoại Thất')
            ],
        ];
        DB::table('lv_typeproduct')->insert($data);
    }
}
