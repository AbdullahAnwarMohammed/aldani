<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arabic_countries = [
            "الأردن",
            "الإمارات العربية المتحدة",
            "البحرين",
            "الجزائر",
            "السعودية",
            "السودان",
            "الصومال",
            "العراق",
            "عمان",
            "فلسطين",
            "قطر",
            "الكويت",
            "لبنان",
            "ليبيا",
            "مصر",
            "المغرب",
            "موريتانيا",
            "اليمن",
            "جيبوتي",
            "جزر القمر",
            "سوريا",
            "تونس"
        ];
        foreach ($arabic_countries as $country) {
            Country::create([
                'country_name' => $country
            ]);
        }
    }
}
