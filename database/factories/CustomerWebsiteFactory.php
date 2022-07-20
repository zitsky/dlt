<?php


namespace Database\Factories;


use App\Models\CustomerWebsiteModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerWebsiteFactory extends Factory
{
    protected $model = CustomerWebsiteModel::class;
    static $endings = ["com","ru","eu","su"];

    public function definition()
    {
        return [
            'website' => $this->randomSuffix(Str::random())
        ];
    }

    private function randomSuffix($domain) {
        return sprintf("%s.%s",$domain,static::$endings[rand(0,3)]);
    }
}
