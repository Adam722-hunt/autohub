<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;

class conditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conditions')->insert([
            ['name'=>'Used'],
            ['name'=>'Almost New'],
            ['name'=>'Damaged'],
            ['name'=>'Parts Only'],
        ]);
    }
}
