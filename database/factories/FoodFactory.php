<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        return [
            'name' => $faker->foodName(),
            'price' => rand(10, 50),
            'category' => $this->faker->randomElement($array = array('Breakfast', 'Launch', 'Dinner')),
            'description' => $this->faker->text(),
            'image' => $this->faker->randomElement($array = array('menu-1.jpg','menu-2.jpg','menu-3.jpg','menu-4.jpg','menu-5.jpg','menu-6.jpg','menu-7.jpg','menu-8.jpg'))
        ];
    }
}