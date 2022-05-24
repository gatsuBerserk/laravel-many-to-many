<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Model\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {  
        $categories = [
            'funny', 
            'holiday', 
            'adventure', 
            'travel', 
            'vlogging', 
            'sport', 
            'food', 
            'environment', 
            'politics',
            'drink'
        ];

        for ($i=0; $i < count($categories) ; $i++) {
            $newCategory = new Category();
            $newCategory->name = $categories[$i];
            $newCategory->color = $faker->unique()->hexColor();
            $newCategory->save();
        }
    }
}
