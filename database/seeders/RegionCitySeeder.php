<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            'Алматы' => ['Алматы'],
            'Астана' => ['Астана'],
            'Алматинская область' => ['Каскелен', 'Конаев', 'Талгар'],
            'Акмолинская область' => ['Кокшетау', 'Щучинск'],
            'Мангистауская область' => ['Актау', 'Бейнеу', 'Жанаозен'],
        ];

        foreach ($regions as $regionName => $cities) {
            $region = Region::create(['name' => $regionName]);
            foreach ($cities as $cityName) {
                City::create([
                    'name' => $cityName,
                    'region_id' => $region->id
                ]);
            }
        }
    }
}
