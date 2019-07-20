<?php

use Illuminate\Database\Seeder;
use App\Models\Post\Tag;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Tag::class, 20)->create();
    }
}
