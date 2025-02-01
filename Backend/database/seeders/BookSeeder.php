<?php

namespace Database\Seeders;

use App\Models\books;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        books::create([
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'book_created' => '1813-01-28',
            'description' => 'Autorka ukazuje życie angielskich wyższych sfer na przełomie XVIII i XIX wieku.',
        ]);

        books::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'book_created' => '1949-06-08',
            'description' => 'Futurystyczna dystopia o licznych podtekstach politycznych, napisana przez George\'\a Orwella.',
        ]);

        books::create([
            'title' => 'Jane Eyre',
            'author' => 'Charlotte Brontë',
            'book_created' => '1847-10-19',
            'description' => 'Opowiada ona historię dziewczynki, która straciła rodziców, przez co trafia do domu wuja',
        ]);
    }
}
