<?php

namespace App\Exports;

use App\Models\Almustawayat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlmustawayatExportSQL  implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Almustawayat::all();
    }

    /*
    `id`, `name`, `comment`, `created_at`, `updated_at`
    */

    public function map($talib): array
    {
        return [
            $talib->id,
            $talib->name,
            $talib->comment,
            $talib->created_at,
            $talib->updated_at,
        ];
    }

    public function headings(): array
    {
       
        return [
            'id',
            'name',
            'comment',
            'created_at',
            'updated_at',
        ];
    }
}
