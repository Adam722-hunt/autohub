<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class citiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Casablanca', 'country_id' => 1],
            ['name' => 'Rabat', 'country_id' => 1],
            ['name' => 'Marrakech', 'country_id' => 1],
            ['name' => 'Fes', 'country_id' => 1],
            ['name' => 'Tangier', 'country_id' => 1],
            ['name' => 'Agadir', 'country_id' => 1],
            ['name' => 'Meknes', 'country_id' => 1],
            ['name' => 'Oujda', 'country_id' => 1],
            ['name' => 'Kenitra', 'country_id' => 1],
            ['name' => 'Tetouan', 'country_id' => 1],

            ['name' => 'Algiers', 'country_id' => 2],
            ['name' => 'Oran', 'country_id' => 2],
            ['name' => 'Constantine', 'country_id' => 2],
            ['name' => 'Annaba', 'country_id' => 2],
            ['name' => 'Blida', 'country_id' => 2],

            ['name' => 'Tunis', 'country_id' => 3],
            ['name' => 'Sfax', 'country_id' => 3],
            ['name' => 'Sousse', 'country_id' => 3],
            ['name' => 'Bizerte', 'country_id' => 3],

            ['name' => 'Cairo', 'country_id' => 4],
            ['name' => 'Alexandria', 'country_id' => 4],
            ['name' => 'Giza', 'country_id' => 4],
            ['name' => 'Luxor', 'country_id' => 4],
            ['name' => 'Aswan', 'country_id' => 4],

            ['name' => 'Cape Town', 'country_id' => 5],
            ['name' => 'Johannesburg', 'country_id' => 5],
            ['name' => 'Durban', 'country_id' => 5],
            ['name' => 'Pretoria', 'country_id' => 5],
            ['name' => 'Port Elizabeth', 'country_id' => 5],

            ['name' => 'Lagos', 'country_id' => 6],
            ['name' => 'Abuja', 'country_id' => 6],
            ['name' => 'Kano', 'country_id' => 6],
            ['name' => 'Ibadan', 'country_id' => 6],
            ['name' => 'Port Harcourt', 'country_id' => 6],

            ['name' => 'Nairobi', 'country_id' => 7],
            ['name' => 'Mombasa', 'country_id' => 7],
            ['name' => 'Kisumu', 'country_id' => 7],
            ['name' => 'Nakuru', 'country_id' => 7],

            ['name' => 'Accra', 'country_id' => 8],
            ['name' => 'Kumasi', 'country_id' => 8],
            ['name' => 'Tamale', 'country_id' => 8],
            ['name' => 'Tema', 'country_id' => 8],

            ['name' => 'Addis Ababa', 'country_id' => 9],
            ['name' => 'Dire Dawa', 'country_id' => 9],
            ['name' => 'Gondar', 'country_id' => 9],

            ['name' => 'Luanda', 'country_id' => 10],
            ['name' => 'Huambo', 'country_id' => 10],
            ['name' => 'Lubango', 'country_id' => 10],

            ['name' => 'London', 'country_id' => 52],
            ['name' => 'Manchester', 'country_id' => 52],
            ['name' => 'Birmingham', 'country_id' => 52],
            ['name' => 'Liverpool', 'country_id' => 52],
            ['name' => 'Edinburgh', 'country_id' => 52],
            ['name' => 'Glasgow', 'country_id' => 52],
            ['name' => 'Bristol', 'country_id' => 52],

            ['name' => 'Paris', 'country_id' => 53],
            ['name' => 'Marseille', 'country_id' => 53],
            ['name' => 'Lyon', 'country_id' => 53],
            ['name' => 'Toulouse', 'country_id' => 53],
            ['name' => 'Nice', 'country_id' => 53],
            ['name' => 'Bordeaux', 'country_id' => 53],
            ['name' => 'Lille', 'country_id' => 53],

            ['name' => 'Berlin', 'country_id' => 54],
            ['name' => 'Munich', 'country_id' => 54],
            ['name' => 'Hamburg', 'country_id' => 54],
            ['name' => 'Cologne', 'country_id' => 54],
            ['name' => 'Frankfurt', 'country_id' => 54],
            ['name' => 'Stuttgart', 'country_id' => 54],
            ['name' => 'Dusseldorf', 'country_id' => 54],

            ['name' => 'Madrid', 'country_id' => 55],
            ['name' => 'Barcelona', 'country_id' => 55],
            ['name' => 'Valencia', 'country_id' => 55],
            ['name' => 'Seville', 'country_id' => 55],
            ['name' => 'Malaga', 'country_id' => 55],
            ['name' => 'Bilbao', 'country_id' => 55],

            ['name' => 'Lisbon', 'country_id' => 56],
            ['name' => 'Porto', 'country_id' => 56],
            ['name' => 'Braga', 'country_id' => 56],
            ['name' => 'Coimbra', 'country_id' => 56],

            ['name' => 'Rome', 'country_id' => 57],
            ['name' => 'Milan', 'country_id' => 57],
            ['name' => 'Naples', 'country_id' => 57],
            ['name' => 'Turin', 'country_id' => 57],
            ['name' => 'Florence', 'country_id' => 57],
            ['name' => 'Venice', 'country_id' => 57],
            ['name' => 'Bologna', 'country_id' => 57],

            ['name' => 'Amsterdam', 'country_id' => 58],
            ['name' => 'Rotterdam', 'country_id' => 58],
            ['name' => 'The Hague', 'country_id' => 58],
            ['name' => 'Utrecht', 'country_id' => 58],
            ['name' => 'Eindhoven', 'country_id' => 58],

            ['name' => 'Brussels', 'country_id' => 59],
            ['name' => 'Antwerp', 'country_id' => 59],
            ['name' => 'Ghent', 'country_id' => 59],
            ['name' => 'Bruges', 'country_id' => 59],

            ['name' => 'Zurich', 'country_id' => 60],
            ['name' => 'Geneva', 'country_id' => 60],
            ['name' => 'Bern', 'country_id' => 60],
            ['name' => 'Basel', 'country_id' => 60],
            ['name' => 'Lausanne', 'country_id' => 60],

            ['name' => 'New York', 'country_id' => 96],
            ['name' => 'Los Angeles', 'country_id' => 96],
            ['name' => 'Chicago', 'country_id' => 96],
            ['name' => 'Houston', 'country_id' => 96],
            ['name' => 'Miami', 'country_id' => 96],
            ['name' => 'San Francisco', 'country_id' => 96],
            ['name' => 'Las Vegas', 'country_id' => 96],
            ['name' => 'Washington D.C.', 'country_id' => 96],
            ['name' => 'Boston', 'country_id' => 96],
            ['name' => 'Seattle', 'country_id' => 96],

            ['name' => 'Toronto', 'country_id' => 97],
            ['name' => 'Vancouver', 'country_id' => 97],
            ['name' => 'Montreal', 'country_id' => 97],
            ['name' => 'Calgary', 'country_id' => 97],
            ['name' => 'Ottawa', 'country_id' => 97],

            ['name' => 'Mexico City', 'country_id' => 98],
            ['name' => 'Guadalajara', 'country_id' => 98],
            ['name' => 'Monterrey', 'country_id' => 98],
            ['name' => 'Cancun', 'country_id' => 98],

            ['name' => 'Sao Paulo', 'country_id' => 114],
            ['name' => 'Rio de Janeiro', 'country_id' => 114],
            ['name' => 'Brasilia', 'country_id' => 114],
            ['name' => 'Salvador', 'country_id' => 114],
            ['name' => 'Fortaleza', 'country_id' => 114],
            ['name' => 'Belo Horizonte', 'country_id' => 114],

            ['name' => 'Buenos Aires', 'country_id' => 115],
            ['name' => 'Cordoba', 'country_id' => 115],
            ['name' => 'Mendoza', 'country_id' => 115],
            ['name' => 'Rosario', 'country_id' => 115],

            ['name' => 'Beijing', 'country_id' => 126],
            ['name' => 'Shanghai', 'country_id' => 126],
            ['name' => 'Guangzhou', 'country_id' => 126],
            ['name' => 'Shenzhen', 'country_id' => 126],
            ['name' => 'Chengdu', 'country_id' => 126],
            ['name' => 'Hong Kong', 'country_id' => 126],

            ['name' => 'Tokyo', 'country_id' => 127],
            ['name' => 'Osaka', 'country_id' => 127],
            ['name' => 'Nagoya', 'country_id' => 127],
            ['name' => 'Yokohama', 'country_id' => 127],
            ['name' => 'Kyoto', 'country_id' => 127],
            ['name' => 'Fukuoka', 'country_id' => 127],

            ['name' => 'Mumbai', 'country_id' => 128],
            ['name' => 'Delhi', 'country_id' => 128],
            ['name' => 'Bangalore', 'country_id' => 128],
            ['name' => 'Chennai', 'country_id' => 128],
            ['name' => 'Kolkata', 'country_id' => 128],
            ['name' => 'Hyderabad', 'country_id' => 128],
            ['name' => 'Pune', 'country_id' => 128],

            ['name' => 'Seoul', 'country_id' => 129],
            ['name' => 'Busan', 'country_id' => 129],
            ['name' => 'Incheon', 'country_id' => 129],
            ['name' => 'Daegu', 'country_id' => 129],

            ['name' => 'Singapore', 'country_id' => 130],

            ['name' => 'Kuala Lumpur', 'country_id' => 131],
            ['name' => 'Penang', 'country_id' => 131],
            ['name' => 'Johor Bahru', 'country_id' => 131],
            ['name' => 'Kuching', 'country_id' => 131],

            ['name' => 'Jakarta', 'country_id' => 132],
            ['name' => 'Surabaya', 'country_id' => 132],
            ['name' => 'Bandung', 'country_id' => 132],
            ['name' => 'Bali', 'country_id' => 132],

            ['name' => 'Manila', 'country_id' => 133],
            ['name' => 'Cebu', 'country_id' => 133],
            ['name' => 'Davao', 'country_id' => 133],
            ['name' => 'Quezon City', 'country_id' => 133],

            ['name' => 'Sydney', 'country_id' => 167],
            ['name' => 'Melbourne', 'country_id' => 167],
            ['name' => 'Brisbane', 'country_id' => 167],
            ['name' => 'Perth', 'country_id' => 167],
            ['name' => 'Adelaide', 'country_id' => 167],
            ['name' => 'Gold Coast', 'country_id' => 167],


            ['name' => 'Auckland', 'country_id' => 168],
            ['name' => 'Wellington', 'country_id' => 168],
            ['name' => 'Christchurch', 'country_id' => 168],
            ['name' => 'Hamilton', 'country_id' => 168],


            ['name' => 'Dubai', 'country_id' => 135],
            ['name' => 'Abu Dhabi', 'country_id' => 135],
            ['name' => 'Sharjah', 'country_id' => 135],


            ['name' => 'Riyadh', 'country_id' => 134],
            ['name' => 'Jeddah', 'country_id' => 134],
            ['name' => 'Mecca', 'country_id' => 134],
            ['name' => 'Medina', 'country_id' => 134],
            ['name' => 'Dammam', 'country_id' => 134],


            ['name' => 'Istanbul', 'country_id' => 75],
            ['name' => 'Ankara', 'country_id' => 75],
            ['name' => 'Izmir', 'country_id' => 75],
            ['name' => 'Antalya', 'country_id' => 75],
            ['name' => 'Bursa', 'country_id' => 75],

            ['name' => 'Moscow', 'country_id' => 76],
            ['name' => 'Saint Petersburg', 'country_id' => 76],
            ['name' => 'Novosibirsk', 'country_id' => 76],
            ['name' => 'Kazan', 'country_id' => 76],

            ['name' => 'Stockholm', 'country_id' => 63],
            ['name' => 'Gothenburg', 'country_id' => 63],
            ['name' => 'Malmo', 'country_id' => 63],


            ['name' => 'Oslo', 'country_id' => 64],
            ['name' => 'Bergen', 'country_id' => 64],


            ['name' => 'Copenhagen', 'country_id' => 65],
            ['name' => 'Aarhus', 'country_id' => 65],

            ['name' => 'Warsaw', 'country_id' => 68],
            ['name' => 'Krakow', 'country_id' => 68],
            ['name' => 'Gdansk', 'country_id' => 68],


            ['name' => 'Prague', 'country_id' => 69],
            ['name' => 'Brno', 'country_id' => 69],

            ['name' => 'Budapest', 'country_id' => 71],
            ['name' => 'Debrecen', 'country_id' => 71],


            ['name' => 'Athens', 'country_id' => 74],
            ['name' => 'Thessaloniki', 'country_id' => 74],


            ['name' => 'Bogota', 'country_id' => 118],
            ['name' => 'Medellin', 'country_id' => 118],
            ['name' => 'Cali', 'country_id' => 118],


            ['name' => 'Lima', 'country_id' => 119],
            ['name' => 'Cusco', 'country_id' => 119],


            ['name' => 'Santiago', 'country_id' => 117],
            ['name' => 'Valparaiso', 'country_id' => 117],


            ['name' => 'Karachi', 'country_id' => 139],
            ['name' => 'Lahore', 'country_id' => 139],
            ['name' => 'Islamabad', 'country_id' => 139],


            ['name' => 'Jerusalem', 'country_id' => 145],
            ['name' => 'Tel Aviv', 'country_id' => 145],
            ['name' => 'Haifa', 'country_id' => 145],

    
            ['name' => 'Lagos', 'country_id' => 6],
            ['name' => 'Abuja', 'country_id' => 6],
        ]);
    }
}