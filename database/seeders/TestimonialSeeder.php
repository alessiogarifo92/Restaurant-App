<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Testimonial::factory(4)->create([]);

        ///////////// ESPERIMENTI /////////////
        // Testimonial::factory()->create([
//SE SCRITTO RICHIAMANDO FACTORY, EFFETTIVAMENTE FUNZIONA PERO AGGIUNGE LA COLONNA 0 NON SO PER QUALE MOTIVO E DA ERRORE
                // 'name' => Testimonial::factory()->create(['name']),
                // 'profession' => 'Secretary',
                // 'feedback' => Testimonial::factory()->create(['feedback']),
                // 'image' => 'testimonial-1.jpg'

//SE SCRITTO TUTTO A MANO OK
            // 'name' => 'Clara',
            // 'profession' => 'Architect',
            // 'feedback' => 'cazzate',
            // 'image' => 'testimonial-2.jpg'
        // ]);
    }
}