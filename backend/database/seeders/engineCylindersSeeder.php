<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
class engineCylindersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('engine_cylinders')->insert([
            ['name'=>'1 Cylinder'],
            ['name'=>'2 Cylinders'],
            ['name'=>'3 Cylinders'],
            ['name'=>'4 Cylinders'],
            ['name'=>'5 Cylinders'],
            ['name'=>'6 Cylinders'],
            ['name'=>'8 Cylinders'],
            ['name'=>'10 Cylinders'],
            ['name'=>'12 Cylinders'],
            ['name'=>'16 Cylinders'],
            ['name'=>'2-Rotor'],
            ['name'=>'3-Rotor'],
            ['name'=>'4-Rotor'],
        ]);
    }
}
