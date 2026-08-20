<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
class bodyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('body_types')->insert([
            ['name'=>'Sedan'],
            ['name'=>'Coupe'],
            ['name'=>'Hatchback'],
            ['name'=>'SUV'],
            ['name'=>'Crossover'],
            ['name'=>'Wagon'],
            ['name'=>'Convertible'],
            ['name'=>'Pickup'],
            ['name'=>'Van'],
            ['name'=>'Minivan'],
            ['name'=>'Roadster'],
            ['name'=>'Fastback'],
            ['name'=>'Liftback'],
            ['name'=>'Targa'],
        ]);
    }
}
