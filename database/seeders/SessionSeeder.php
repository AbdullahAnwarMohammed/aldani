<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'الفصل الأول	', 'from' => 9 ,'to' => 12],
            ['name' => 'الفصل الثاني', 'from' => 2,'to' => 7],
            ['name' => 'الفصل الصيفي', 'from' => 8,'to' => 8],
        ];
        foreach ($data as $fieldData) {
            Session::create([
                'name' => $fieldData['name'],
                'from' => $fieldData['from'],
                'to' => $fieldData['to'],
            ]);
        }
    }
}
