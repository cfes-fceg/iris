<?php

namespace Database\Factories;

use App\Models\Session;
use App\Models\SessionStream;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    protected $model = Session::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $stream = SessionStream::inRandomOrder()->first();
        $startDate = $this->faker->dateTime();
        $endDate = $startDate->add(new \DateInterval('PT1H'));

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraphs(2, true),
            'is_published' => $this->faker->boolean(90),
            'session_stream_id' => isset($stream) ? $stream->id : null,
            'start' => $startDate,
            'end' => $endDate
        ];
    }
}
