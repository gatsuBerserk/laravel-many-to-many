<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Model\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ( $i = 0; $i < 50 ; $i++) { 
            $newPost = new Post();
            $newPost->title = $faker->words(3, true);
            $newPost->author = $faker->name();
            $newPost->content = $faker->paragraph(3, false);
            $newPost->image_url = "https://picsum.photos/200/300?random=" . $i;
            $newPost->save();
        }
    }
}
