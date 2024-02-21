<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
   

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $img=['f.jpg','f2.jpg','front.jpg','grid.jpg','im.jpg','penny.jpg'];
        $genre=[ "Fiction",
        "Poetry",
        "Nonfiction",
        "Drama",
        "Romance",
        "Mystery",
        "Thriller",
        "Science Fiction",
        "Fantacies",
        "Horror",
        "History",];

        $rf=rand(0,10);
        $fi=rand(0,5);
        $rand=rand(1,20);
        return [
            
            'title' => fake()->name(),
            'author' => fake()->name(),
            'description'=>fake()->text(),
            'user_id' =>$rand,
            'location'=>'',
            'hard_copy'=>'soft',
            'link'=>'cambg_1.jpg',
            'free'=>"false",
            'price'=>"2000",
            'image'=>$img[$fi],
            'genre'=>$genre[$rf],
            'page'=>205,
            'ISBN'=>rand(1003,40095),
            'language'=>fake()->languageCode(),
            'num_download'=>0,
            'num_comments'=>0
        ];
    }

    
}
