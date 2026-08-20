<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
class featureCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('feature_categories')->insert([
            ['name'=>'Safety'],
            ['name'=>'Comfort'],
            ['name'=>'Multimedia'],
            ['name'=>'Interior'],
            ['name'=>'Exterior'],
            ['name'=>'Performance'],
            ['name'=>'Convenience'],
        ]);
    }
}
