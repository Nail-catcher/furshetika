<?php

namespace Database\Seeders;

use App\Models\Texted;
use Illuminate\Database\Seeder;

class TextesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newTexted = new Texted([
            'text'=>"Фуршетика-лучшие мероприятия с доставкой на дом!",
            'category'=>"main",

        ]);
        $newTexted->save();
    }
}
