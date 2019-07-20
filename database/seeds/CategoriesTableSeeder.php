<?php

use Illuminate\Database\Seeder;
use App\Models\Post\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Category::class, 10)->create();
    }
}
