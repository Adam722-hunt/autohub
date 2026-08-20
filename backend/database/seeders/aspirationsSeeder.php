<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
class aspirationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('aspirations')->insert([
            ['name'=>'Naturally Aspirated'],
            ['name'=>'Turbocharged'],
            ['name'=>'Twin Turbo'],
            ['name'=>'Supercharged'],
            ['name'=>'Twincharged'],
        ]);
    }
}
