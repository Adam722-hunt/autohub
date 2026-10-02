<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_settings')->insert([
            ['key' => 'site_name', 'value' => 'AutoHub'],
            ['key' => 'max_photos_per_listing', 'value' => 10],
            ['key' => 'enable_messaging', 'value' => true],
            ['key' => 'auto_approve_listing', 'value' => false],
            ['key' => 'verify_user', 'value' => 'true'],
            ['key' => 'notify_new_user_registration', 'value' => 'true'],
            ['key' => 'notify_new_report_submitted', 'value' => 'true'],
            ['key' => 'notify_new_listing_created', 'value' => 'true'],
        ]);
    }
}
