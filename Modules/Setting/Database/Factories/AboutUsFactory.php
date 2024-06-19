<?php

namespace Modules\Setting\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Setting\App\Models\AboutUs;

class AboutUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = AboutUs::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => __('about_us'),
            'content' => fake()->paragraphs(10, true),
        ];
    }
}

