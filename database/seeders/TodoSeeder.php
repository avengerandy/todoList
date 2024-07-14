<?php

namespace Database\Seeders;

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
        for ($i = 0; $i < 3; $i++) {
            $todo = new Todo();
            $todo->title = "testTitle0{$i}";
            $todo->description = "testDescription0{$i}";
            $todo->save();
        }
    }
}
