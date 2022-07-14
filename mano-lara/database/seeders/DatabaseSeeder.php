<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        $animals = ['Big cat', 'Tiger', 'Puma', 'Penguin', 'Zebro', 'Racoon', 'Donkey', 'Snake', 'Koala', 'Panda'];

        foreach(range(1, 77) as $_) {
            DB::table('animals')->insert([
                'name' => $animals[rand(0, count($animals) - 1)],
                'color_id' => rand(1, 10),
            ]);
        }


        DB::table('users')->insert([
            'name' => 'bebras',
            'email' => 'bebras@gmail.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'briedis',
            'email' => 'briedis@gmail.com',
            'password' => Hash::make('123'),
            'role' => 10,
        ]);

    }
}
