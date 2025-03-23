<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SauceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('sauces')->insert([
            [
                'userId' => '1',
                'name' => 'Sriracha',
                'manufacturer' => 'Huy Fong Foods',
                'description' => 'Sauce piquante à base de piments rouges et d’ail.',
                'mainPepper' => 'Piment rouge',
                'imageUrl' => 'https://example.com/images/sriracha.jpg',
                'heat' => 4,
                'likes' => 120,
                'dislikes' => 5,
                'usersLiked' => json_encode([1, 2, 3]),
                'usersDisliked' => json_encode([4, 5]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'userId' => '2',
                'name' => 'Tabasco',
                'manufacturer' => 'McIlhenny Company',
                'description' => 'Sauce piquante à base de piments Tabasco et de vinaigre.',
                'mainPepper' => 'Piment Tabasco',
                'imageUrl' => 'https://example.com/images/tabasco.jpg',
                'heat' => 3,
                'likes' => 95,
                'dislikes' => 10,
                'usersLiked' => json_encode([2, 6, 7]),
                'usersDisliked' => json_encode([8, 9]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'userId' => '3',
                'name' => 'Cholula',
                'manufacturer' => 'Cholula Food Company',
                'description' => 'Sauce mexicaine au goût équilibré et aux piments jalapeños.',
                'mainPepper' => 'Jalapeño',
                'imageUrl' => 'https://example.com/images/cholula.jpg',
                'heat' => 2,
                'likes' => 150,
                'dislikes' => 3,
                'usersLiked' => json_encode([1, 4, 6]),
                'usersDisliked' => json_encode([7, 8]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
