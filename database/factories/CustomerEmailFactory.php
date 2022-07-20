<?php


namespace Database\Factories;


use App\Models\CustomerEmailModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerEmailFactory extends Factory
{
    protected $model = CustomerEmailModel::class;

    public function definition()
    {
        return [
            'default' => false,
            'email' => $this->faker->unique()->email
        ];
    }
}
