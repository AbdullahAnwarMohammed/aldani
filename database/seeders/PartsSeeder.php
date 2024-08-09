<?php

namespace Database\Seeders;

use App\Models\Almustawayat;
use App\Models\Part;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Almustawayats = Almustawayat::all();
        $arrays = range(1, 30);
        foreach($Almustawayats as $item)
        {
            foreach($arrays as $array)
            {
                Part::create([
                    'title' => $array,
                    'almustawayat_id' => $item->id
                ]);
            }
        }
    }
}
