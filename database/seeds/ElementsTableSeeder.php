<?php

use Illuminate\Database\Seeder;

class ElementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Element::class, 50)->create();
        factory(App\TextElement::class, 50)->create();
    }
}
