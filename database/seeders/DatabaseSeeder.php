<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        // \App\Models\Food::factory(16)->create();
        //INDISPENSABILE SCRIVERE QUI INFO A MENO CHE NON SI RICHIAMI SEEDER SINGOLO MA CON php artisan db:seed PASSA DI QUA
        $this->call([
            TestimonialSeeder::class,
            FoodSeeder::class
        ]);
    }
}