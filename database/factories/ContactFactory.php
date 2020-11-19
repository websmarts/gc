<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Contact;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'uuid' => (string) Str::uuid(),
            'address_id' => Address::factory(1)->create()->first()->id,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            
        ];
    }
}
