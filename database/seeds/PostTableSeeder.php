<?php

use App\Post;
use App\Category;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        $categories = Category::all();

        foreach($categories as $key => $c){

            for($i=1; $i<=20; $i++){
                Post::create([
                    'title' => "Post $i $key",
                    'url_clean' => "post-$i-$key",
                    "content" => "orl año  creación de las hojas",
                    'posted' => 'yes',
                    'category_id' => $c->id,
                    ]);
            }
        }
     
       
    }
}
