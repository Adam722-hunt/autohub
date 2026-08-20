<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transmissions')->insert([
            ['name'=> 'Manual'],
            ['name'=> 'Automatic'],
            ['name'=> 'CVT'],
            ['name'=> 'DCT'],
            ['name'=> 'Sequential'],
        ]);
    }
}
