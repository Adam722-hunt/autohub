<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class currenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->insert([
            ['name' => 'Moroccan Dirham', 'code' => 'MAD', 'symbol' => 'د.م.'],
            ['name' => 'Algerian Dinar', 'code' => 'DZD', 'symbol' => 'د.ج'],
            ['name' => 'Tunisian Dinar', 'code' => 'TND', 'symbol' => 'د.ت'],
            ['name' => 'Egyptian Pound', 'code' => 'EGP', 'symbol' => 'E£'],
            ['name' => 'South African Rand', 'code' => 'ZAR', 'symbol' => 'R'],
            ['name' => 'Nigerian Naira', 'code' => 'NGN', 'symbol' => '₦'],
            ['name' => 'Kenyan Shilling', 'code' => 'KES', 'symbol' => 'KSh'],
            ['name' => 'Ghanaian Cedi', 'code' => 'GHS', 'symbol' => '₵'],
            ['name' => 'Ethiopian Birr', 'code' => 'ETB', 'symbol' => 'Br'],
            ['name' => 'Angolan Kwanza', 'code' => 'AOA', 'symbol' => 'Kz'],
            ['name' => 'Mozambican Metical', 'code' => 'MZN', 'symbol' => 'MT'],

            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'British Pound', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Swiss Franc', 'code' => 'CHF', 'symbol' => 'Fr'],
            ['name' => 'Swedish Krona', 'code' => 'SEK', 'symbol' => 'kr'],
            ['name' => 'Norwegian Krone', 'code' => 'NOK', 'symbol' => 'kr'],
            ['name' => 'Danish Krone', 'code' => 'DKK', 'symbol' => 'kr'],
            ['name' => 'Polish Zloty', 'code' => 'PLN', 'symbol' => 'zł'],
            ['name' => 'Czech Koruna', 'code' => 'CZK', 'symbol' => 'Kč'],
            ['name' => 'Hungarian Forint', 'code' => 'HUF', 'symbol' => 'Ft'],
            ['name' => 'Romanian Leu', 'code' => 'RON', 'symbol' => 'lei'],
            ['name' => 'Bulgarian Lev', 'code' => 'BGN', 'symbol' => 'лв'],
            ['name' => 'Croatian Kuna', 'code' => 'HRK', 'symbol' => 'kn'],
            ['name' => 'Russian Ruble', 'code' => 'RUB', 'symbol' => '₽'],
            ['name' => 'Turkish Lira', 'code' => 'TRY', 'symbol' => '₺'],
            ['name' => 'Ukrainian Hryvnia', 'code' => 'UAH', 'symbol' => '₴'],
            ['name' => 'Icelandic Króna', 'code' => 'ISK', 'symbol' => 'kr'],

            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'Canadian Dollar', 'code' => 'CAD', 'symbol' => 'C$'],
            ['name' => 'Mexican Peso', 'code' => 'MXN', 'symbol' => '$'],
            ['name' => 'Cuban Peso', 'code' => 'CUP', 'symbol' => '$'],
            ['name' => 'Dominican Peso', 'code' => 'DOP', 'symbol' => 'RD$'],
            ['name' => 'Jamaican Dollar', 'code' => 'JMD', 'symbol' => 'J$'],
            ['name' => 'Trinidad and Tobago Dollar', 'code' => 'TTD', 'symbol' => 'TT$'],

            ['name' => 'Brazilian Real', 'code' => 'BRL', 'symbol' => 'R$'],
            ['name' => 'Argentine Peso', 'code' => 'ARS', 'symbol' => '$'],
            ['name' => 'Chilean Peso', 'code' => 'CLP', 'symbol' => '$'],
            ['name' => 'Colombian Peso', 'code' => 'COP', 'symbol' => '$'],
            ['name' => 'Peruvian Sol', 'code' => 'PEN', 'symbol' => 'S/'],
            ['name' => 'Venezuelan Bolívar', 'code' => 'VES', 'symbol' => 'Bs.'],
            ['name' => 'Uruguayan Peso', 'code' => 'UYU', 'symbol' => '$U'],
            ['name' => 'Paraguayan Guarani', 'code' => 'PYG', 'symbol' => '₲'],
            ['name' => 'Bolivian Boliviano', 'code' => 'BOB', 'symbol' => 'Bs.'],
            ['name' => 'Costa Rican Colón', 'code' => 'CRC', 'symbol' => '₡'],
            ['name' => 'Guatemalan Quetzal', 'code' => 'GTQ', 'symbol' => 'Q'],

            ['name' => 'Chinese Yuan', 'code' => 'CNY', 'symbol' => '¥'],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥'],
            ['name' => 'Indian Rupee', 'code' => 'INR', 'symbol' => '₹'],
            ['name' => 'South Korean Won', 'code' => 'KRW', 'symbol' => '₩'],
            ['name' => 'Singapore Dollar', 'code' => 'SGD', 'symbol' => 'S$'],
            ['name' => 'Malaysian Ringgit', 'code' => 'MYR', 'symbol' => 'RM'],
            ['name' => 'Indonesian Rupiah', 'code' => 'IDR', 'symbol' => 'Rp'],
            ['name' => 'Philippine Peso', 'code' => 'PHP', 'symbol' => '₱'],
            ['name' => 'Vietnamese Dong', 'code' => 'VND', 'symbol' => '₫'],
            ['name' => 'Thai Baht', 'code' => 'THB', 'symbol' => '฿'],
            ['name' => 'Saudi Riyal', 'code' => 'SAR', 'symbol' => 'ر.س'],
            ['name' => 'UAE Dirham', 'code' => 'AED', 'symbol' => 'د.إ'],
            ['name' => 'Kuwaiti Dinar', 'code' => 'KWD', 'symbol' => 'د.ك'],
            ['name' => 'Qatari Riyal', 'code' => 'QAR', 'symbol' => 'ر.ق'],
            ['name' => 'Omani Rial', 'code' => 'OMR', 'symbol' => 'ر.ع.'],
            ['name' => 'Bahraini Dinar', 'code' => 'BHD', 'symbol' => 'د.ب'],
            ['name' => 'Pakistani Rupee', 'code' => 'PKR', 'symbol' => '₨'],
            ['name' => 'Bangladeshi Taka', 'code' => 'BDT', 'symbol' => '৳'],
            ['name' => 'Sri Lankan Rupee', 'code' => 'LKR', 'symbol' => 'Rs'],
            ['name' => 'Nepalese Rupee', 'code' => 'NPR', 'symbol' => '₨'],
            ['name' => 'Taiwanese Dollar', 'code' => 'TWD', 'symbol' => 'NT$'],
            ['name' => 'Hong Kong Dollar', 'code' => 'HKD', 'symbol' => 'HK$'],
            ['name' => 'Israeli Shekel', 'code' => 'ILS', 'symbol' => '₪'],
            ['name' => 'Iranian Rial', 'code' => 'IRR', 'symbol' => '﷼'],
            ['name' => 'Iraqi Dinar', 'code' => 'IQD', 'symbol' => 'د.ع'],
            ['name' => 'Syrian Pound', 'code' => 'SYP', 'symbol' => '£S'],
            ['name' => 'Jordanian Dinar', 'code' => 'JOD', 'symbol' => 'د.ا'],
            ['name' => 'Lebanese Pound', 'code' => 'LBP', 'symbol' => 'ل.ل'],
            ['name' => 'Yemeni Rial', 'code' => 'YER', 'symbol' => '﷼'],
            ['name' => 'Afghan Afghani', 'code' => 'AFN', 'symbol' => '؋'],
            ['name' => 'Myanmar Kyat', 'code' => 'MMK', 'symbol' => 'K'],

            ['name' => 'Australian Dollar', 'code' => 'AUD', 'symbol' => 'A$'],
            ['name' => 'New Zealand Dollar', 'code' => 'NZD', 'symbol' => 'NZ$'],
            ['name' => 'Fijian Dollar', 'code' => 'FJD', 'symbol' => 'FJ$'],
            ['name' => 'Papua New Guinean Kina', 'code' => 'PGK', 'symbol' => 'K'],
        ]);
    }
}