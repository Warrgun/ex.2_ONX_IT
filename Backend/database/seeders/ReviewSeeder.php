<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\books;
use App\Models\reviewes;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book1 = books::find(1);
        $book1->userReviewes()->create([
            'name' => 'Bob',
            'rating' => 5,
            'review' => 'An amazing classic with profound themes.',
        ]);

        $book2 = books::find(2);
        $book2->userReviewes()->create([
            'name' => 'Paula',
            'rating' => 4,
            'review' => 'A chilling portrayal of a totalitarian society.',
        ]);
    }
}
