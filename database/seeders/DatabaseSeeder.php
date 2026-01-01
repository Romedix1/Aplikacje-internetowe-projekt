<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\BookCopy;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Biblioteki',
            'email' => 'admin@biblioteka.pl',
            'password' => bcrypt('haslo123'),
            'role' => 'admin',
        ]);

        User::factory(10)->create();

        $books = Book::factory(50)->create();

        foreach ($books as $book) {
            $numberOfCopies = rand(1, 5);

            for ($i = 0; $i < $numberOfCopies; $i++) {
                BookCopy::factory()->create([
                    'book_id' => $book->id,
                    'inventory_number' => 'INV-' . uniqid(true)
                ]);
            }
        }
    }
}