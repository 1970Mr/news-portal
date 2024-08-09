<?php

namespace Modules\ContactUs\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ContactUs\App\Models\ContactInfo;

class ContactInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = ContactInfo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => __('contact_us'),
            'content' => fake()->paragraphs(10, true),
            'address' => fake()->address,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
        ];
    }
}
