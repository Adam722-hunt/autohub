<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
class drivetrainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drivetrains')->insert([
            ['name'=>'FWD'],
            ['name'=>'RWD'],
            ['name'=>'AWD'],
            ['name'=>'4WD'],
        ]);
    }
}
