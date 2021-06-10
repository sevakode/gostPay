<?php

namespace Database\Factories;

use App\Models\Bank\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardTestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    private function generateNumber($id = 1)
    {
        return $this->faker->unique()->numerify("00000$id#########");
    }

    private function generateCvc()
    {

    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->generateNumber(),
            'card_description' => $this->faker->text(100),
            'card_type' => 'Test Corporate',
            'account_code' => '00000000000000000000',
            'bank_code' => '',
            'cvc' => $this->faker->numerify('###'),
            'state' => Card::ACTIVE,
        ];
    }
}
