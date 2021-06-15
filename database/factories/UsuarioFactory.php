<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numberBetween(1, 99999),
            'name' => $this->faker->name,
            'last_name' => $this->faker->lastname,
            'email' => $this->faker->freeEmail,
            'phone_number' => $this->faker->tollFreePhoneNumber,
        ];
    }
}
