<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'name' => $this->faker->firstName(),
                'profession' => $this->faker -> randomElement($array = array ('Chef', 'Architect', 'Secretary')),
                'feedback' => $this->faker->text(),
                'image' => $this->faker -> randomElement($array = array ('testimonial-1.jpg','testimonial-2.jpg','testimonial-3.jpg'))      
        ];
    }
}