<?php

use App\Post;
use App\PostImage;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostImage::truncate();
        $posts = Post::all();

        foreach($posts as $key => $p){

            PostImage::create([
                    'image' => "Pimagen.png",
                    'post_id' => $p->id,
                    ]);
            
        }
     
    }
}
