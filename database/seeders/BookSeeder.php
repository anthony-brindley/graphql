<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfBooks = rand(1000, 10000);

        $books = Book::factory()->count($numberOfBooks)->create();

        $categories = Category::all();

        foreach ($books as $book) {
            $randomCategoryIds = $categories->random(rand(1, 3))->pluck('id')->toArray();
            $book->categories()->attach($randomCategoryIds);
        }
    }
}
