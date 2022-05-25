<?php

use Illuminate\Database\Seeder;
use App\Model\Category;
use App\Model\Post;
use Faker\Generator as Faker;

class CategoryPostTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
         // ? Prendo tutti gli id disponibili in categories
         $category_ids = Category::pluck('id')->toArray();

         // § Prendo tutti gli id disponibili in categories
         $posts = Post::all();
 
         foreach ($posts as $post) {
             $post->categories()->sync($faker->randomElements($category_ids, rand(1,5)));
         }
    }
}
