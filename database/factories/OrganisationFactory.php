<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Organisation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganisationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organisation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company;
        return [
            'uuid'=> Str::uuid(),
            'name'=> $name,
            'slug' => Str::slug($name,'-'),
            'address_id' => Address::factory()->create()->first()->id,
            'gst_registered' => $this->faker->numberBetween(0,1),
            'abn' => (string) $this->faker->randomNumber(9),
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
