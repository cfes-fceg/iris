<?php

namespace Database\Factories;

use App\Models\SessionStream;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionStreamFactory extends Factory
{
    protected $model = SessionStream::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text,
        ];
    }
}
