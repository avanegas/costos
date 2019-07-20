<?php

use Illuminate\Database\Seeder;
use App\Models\Post\Post;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 20)->create()->each(function(Post $post) {
        	$post->tags()->attach([
        		rand(1,5),
        		rand(6,14),
        		rand(15,20),
        	]);
        });
    }
}
