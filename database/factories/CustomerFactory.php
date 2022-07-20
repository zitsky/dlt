<?php


namespace Database\Factories;


use App\Models\CustomerModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = CustomerModel::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'created_at'=> $this->faker->dateTimeBetween('-1 year'),
            'country_id'=> 'RU'
        ];
    }
}
