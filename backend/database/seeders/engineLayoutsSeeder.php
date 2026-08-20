<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
class engineLayoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('engine_layouts')->insert([
            ['name'=>'Inline'],
            ['name'=>'V'],
            ['name'=>'Boxer'],
            ['name'=>'Rotary'],
            ['name'=>'W'],
        ]);
    }
}
