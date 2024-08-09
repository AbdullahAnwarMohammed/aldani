<?php

namespace App\Imports;

use App\Models\Tasmie;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TasmieImport implements ToModel,WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tasmie([
            'id' => $row['id'],
            'talib_id' => $row['talib_id'],
            'user_id' =>  $row['user_id'],
            'attend' =>  $row['attend'],
            'part_id' =>  $row['part_id'],
            'almanhaj_id' => $row['almanhaj_id'],
            'number_of_quarters' => $row['number_of_quarters'],
            'degree' => $row['degree'],
            'comment' => $row['comment'],
            'date' => $row['date'],
            'remember_token' => $row['remember_token'],
            "created_at" => $row['created_at'],
            "updated_at" => $row['updated_at']
        ]);
    }
}
