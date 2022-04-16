<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[];

        $cName='Без категории';
        $categories[]=[
            'title'=>$cName,
            'slug'=>Str::of($cName)->slug(),
            'parent_id'=>0,
        ];

        for ($x=0;$x<=10;$x++){
            $cName='Категория #'.$x;
            $parent=($x>4)?rand(1,5):1;
            $categories[]=[
                'title'=>$cName,
                'slug'=>Str::of($cName)->slug(),
                'parent_id'=>$parent,
            ];
        }
        DB::table('blog_categories')->insert($categories);
    }
}
