<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(20),
        'logo' => $this->faker->image(300,240),
       'favicon' => $this->faker->image(150,70),
           'facebook' => $this->faker->url(),
'github' => $this->faker->url()
        ];
    }
}
