<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
class colorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colors')->insert([
        ['name'=> 'Red'],
        ['name'=> 'Black'],
        ['name'=> 'White'],
        ['name'=> 'yellow'],
        ['name'=> 'orange'],
        ['name'=> 'gray'],
        ['name'=> 'green'],
        ['name'=> 'purple'],
        ['name'=> 'brown'],
        ]);
    }
}
