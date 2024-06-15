<?php

namespace Modules\Menu\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Modules\Category\App\Models\Category;
use Modules\Menu\App\Models\Menu;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Menu\App\Models\Menu::class;
    protected int $position;

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null, ?Collection $recycle = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle);

        $this->position = Menu::query()->max('position') + 1;
    }

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $type = fake()->randomElement(Menu::TYPES);

        return [
            'name' => fake()->word(),
            'url' => fake()->url(),
            'position' => $this->position++,
            'type' => $type,
            'status' => fake()->boolean(80),
            'parent_id' => null,
            'category_id' => null,
        ];
    }
}

