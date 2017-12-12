<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'テクノロジー';
        $category->save();

        $category = new Category();
        $category->name = 'マネジメント';
        $category->save();

        $category = new Category();
        $category->name = 'ストラテジー';
        $category->save();

        $category = new Category();
        $category->name = 'その他';
        $category->save();
    }
}
