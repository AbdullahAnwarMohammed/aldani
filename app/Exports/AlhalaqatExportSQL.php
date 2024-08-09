<?php

namespace App\Exports;

use App\Models\Alhalaqat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlhalaqatExportSQL implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alhalaqat::all();
    }

    public function map($talib): array
    {
        return [
            $talib->id,
            $talib->name,
            $talib->descrption,
            $talib->user_id,
            $talib->room_url,
            $talib->type,
            $talib->created_at,
            $talib->updated_at,
        ];
    }

    public function headings(): array
    {
        /*
`id`, `name`, `descrption`, `user_id`,
 `room_url`, `type`, `created_at`, `updated_at`
        */
        return [
            'id',
            'name',
            'descrption',
            'user_id',
            'room_url',
            'type',
            'created_at',
            'updated_at',
        ];
    }

}
