<?php

namespace Modules\SocialNetwork\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SocialNetwork\App\Models\SocialNetwork;

class SocialNetworkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SocialNetwork::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'url' => fake()->url,
            'tag' => null,
            'owner_type' => null,
            'owner_id' => null,
        ];
    }

    public function withDetails(string $name, string $urlTemplate, string $tag): self
    {
        $url = str_replace(
            ['{username}', '{phone_number}', '{channel_id}'],
            [fake()->userName, fake()->e164PhoneNumber, fake()->uuid],
            $urlTemplate
        );

        return $this->state([
            'name' => $name,
            'url' => $url,
            'tag' => $tag,
        ]);
    }

    public function configure(): self
    {
        return $this->afterMaking(function (SocialNetwork $socialNetwork) {
            SocialNetwork::updateOrCreate(
                ['name' => $socialNetwork->name, 'tag' => $socialNetwork->tag],
                ['url' => $socialNetwork->url]
            );
        });
    }
}
