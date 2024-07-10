<?php

namespace Database\Seeders;

use App\Models\Aldafeuh;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AldafeuhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'الاولي',
            'الثانية',
            'الثالثة',
            'الرابعة',
            'الخامسة',
            'السادسة',
            'السابعة',
            'الثامنة',
            'التاسعة',
            'العاشرة',
        ];
        foreach ($items as $item) {
            Aldafeuh::create([
                'name' => $item
            ]);
        }
    }
}
