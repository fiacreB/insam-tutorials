<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'book_categories_id' => rand(1, 30),
            'views'              => rand(30, 200),
            'pdf_path'           => 'books/pdf/book.pdf',
            'image'              => 'books/covers/cover.jpg',
            'title'              => $this->faker->words(4, true),
            'description'        => $this->faker->paragraph(3, true),
        ];
    }
}
