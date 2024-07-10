<?php

namespace Database\Seeders;

use App\Models\Almustawayat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlmustawayatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'فئة القراءات',
            'الأول',
            'الثاني',
            'الثالث',
            'الرابع',
            'الرابع معدل'	
        ];
        
        foreach($values as $item)
        {
            Almustawayat::create([
                'name' => $item
            ]);
        }
    }

}
