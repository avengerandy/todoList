<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        for ($i = 0; $i < 3; $i++) {
            $todo = new Todo();
            $todo->title = $faker->word();
            $todo->description = $faker->sentence();
            $todo->save();
        }
    }
}
