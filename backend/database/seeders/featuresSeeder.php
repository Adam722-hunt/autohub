<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
class featuresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('features')->insert([
            [
                'name'=>'ABS',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'ESP',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Airbags',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Traction Control',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Blind Spot Monitoring',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Lane Keep Assist',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Adaptive Cruise Control',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Front Airbags',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Side Airbags',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Parking Sensors',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'360 Camera',
                'feature_category_id'=>1,
            ],
            [
                'name'=>'Leather Seats',
                'feature_category_id'=>2,
            ],
            [
                'name'=>'Heated Seats',
                'feature_category_id'=>2,
            ],
            [
                'name'=>'Ventilated Seats',
                'feature_category_id'=>2,
            ],
            [
                'name'=>'Electric Seats',
                'feature_category_id'=>2,
            ],
            [
                'name'=>'Memory Seats',
                'feature_category_id'=>2,
            ],
            [
                'name'=>'Dual Zone Climate Control',
                'feature_category_id'=>2,
            ],
            [
                'name'=>'Keyless Entry',
                'feature_category_id'=>2,
            ],
            [
                'name'=>'Push Button Start',
                'feature_category_id'=>2,
            ],
            [
                'name'=>'Apple CarPlay',
                'feature_category_id'=>3,
            ],
            [
                'name'=>'Android Auto',
                'feature_category_id'=>3,
            ],
            [
                'name'=>'Bluetooth',
                'feature_category_id'=>3,
            ],
            [
                'name'=>'Navigation',
                'feature_category_id'=>3,
            ],
            [
                'name'=>'Premium Sound System',
                'feature_category_id'=>3,
            ],
            [
                'name'=>'USB',
                'feature_category_id'=>3,
            ],
            [
                'name'=>'Wireless Charging',
                'feature_category_id'=>3,
            ],
            [
                'name'=>'LED Headlights',
                'feature_category_id'=>4,
            ],
            [
                'name'=>'Matrix LED',
                'feature_category_id'=>4,
            ],
            [
                'name'=>'Xenon Headlights',
                'feature_category_id'=>4,
            ],
            [
                'name'=>'Sunroof',
                'feature_category_id'=>4,
            ],
            [
                'name'=>'Panoramic Roof',
                'feature_category_id'=>4,
            ],
            [
                'name'=>'Alloy Wheels',
                'feature_category_id'=>4,
            ],
            [
                'name'=>'Digital Dashboard',
                'feature_category_id'=>5,
            ],
            [
                'name'=>'Ambient Lighting',
                'feature_category_id'=>5,
            ],
            [
                'name'=>'Leather Steering Wheel',
                'feature_category_id'=>5,
            ],
            [
                'name'=>'Sport Exhaust',
                'feature_category_id'=>6,
            ],
            [
                'name'=>'Launch Control',
                'feature_category_id'=>6,
            ],
            [
                'name'=>'Adaptive Suspension',
                'feature_category_id'=>6,
            ],
            [
                'name'=>'Power Tailgate',
                'feature_category_id'=>7,
            ],
            [
                'name'=>'Rain Sensor',
                'feature_category_id'=>7,
            ],
            [
                'name'=>'Automatic Headlights',
                'feature_category_id'=>7,
            ],
            [
                'name'=>'Remote Start',
                'feature_category_id'=>7,
            ],
        ]);
    }
}
