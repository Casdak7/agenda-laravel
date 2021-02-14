<?php

namespace Database\Factories;

use App\Models\ContactInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'information' => (rand(0, 1) ?  $this->faker->email : $this->faker->phoneNumber),
            'information_type_id' => rand(1, 5),
            'contact_id' => rand(1, 100),
        ];
    }
}
