<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        

        $fantasyColors = collect(['crimson', 'pink']);

        do {
            $fantasyColors->push($faker->safeColorName);
            $fantasyColors = $fantasyColors->unique();
        } while ($fantasyColors->count() < 10);


        foreach($fantasyColors as $color) {
            DB::table('colors')->insert([
                'color' => $color,
                'title' => $color,
            ]);
        }
    }
}
