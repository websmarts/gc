<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address1'=> $this->faker->streetAddress,
            'address2'=> $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'postcode' => $this->faker->randomNumber(4),
            'state_id' => $this->faker->numberBetween(1,8),
        ];
    }
}
