<?php

namespace App\Exports;

use App\Models\Tasmie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasmieExportSQL implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tasmie::all();
    }
    /*`id`, `talib_id`, `user_id`, `attend`, `part_id`, `almanhaj_id`, 
    `number_of_quarters`, `degree`, `comment`, `date`, `created_at`, `updated_at`*/

    public function map($user): array
    {

        return [
            $user->id,
            $user->talib_id,
            $user->user_id,
            $user->attend,
            $user->part_id,
            $user->almanhaj_id,
            $user->number_of_quarters,
            $user->degree,
            $user->comment,
            $user->date,
            $user->photo,
            $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : null,
            $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }


    public function headings(): array
    {
        return [
            'id',
            'talib_id',
            'user_id',
            'attend',
            'part_id',
            'almanhaj_id',
            'number_of_quarters',
            'degree',
            'comment',
            'date',
            'created_at',
            'updated_at',
        ];
    }
}
