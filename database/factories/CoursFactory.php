<?php

namespace Database\Factories;

use App\Models\Cours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CoursFactory extends Factory
{
    protected $model = Cours::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(4, true),
            'description' => $this->faker->paragraph(2, true),
            'video_path' => 'cours/video.mp4',
            'category_id' => rand(5, 20),
            'visits' => rand(10, 200),
        ];
    }
}
