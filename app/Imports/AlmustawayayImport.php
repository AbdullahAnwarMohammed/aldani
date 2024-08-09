<?php

namespace App\Imports;

use App\Models\Almustawayat;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlmustawayayImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        dd($row);
        /*``id`, `name`, `comment`, `created_at`, `updated_at`*/
        return new Almustawayat([
            'id' => $row['id'],
            'name' => $row['name'],
            'comment' => $row['comment'],
            "created_at" => $row['created_at'],
            "updated_at" => $row['updated_at']
        ]);
    }



    public function rules(): array
    {
        return [
            'name'=>'required|unique:almustawayats,name'

        ];
    }
}
