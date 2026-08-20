<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            VehicleTypeSeeder::class,
            FuelTypeSeeder::class,
            TransmissionSeeder::class,
            drivetrainsSeeder::class,
            bodyTypesSeeder::class,
            conditionsSeeder::class,
            colorsSeeder::class,
            engineLayoutsSeeder::class,
            aspirationsSeeder::class,
            featureCategoriesSeeder::class,
            featuresSeeder::class,
            brandsSeeder::class,
            engineCylindersSeeder::class,
            currenciesSeeder::class,
            countriesSeeder::class,
            citiesSeeder::class,
            ModelSeeder::class,
            vehicleGenSeeder::class
        ]);
    }
}