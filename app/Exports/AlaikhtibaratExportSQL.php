<?php

namespace App\Exports;

use App\Models\Alaikhtibarat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlaikhtibaratExportSQL implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alaikhtibarat::all();
    }


    public function map($talib): array
    {
        return [
            $talib->id,
            $talib->test1,
            $talib->test2,
            $talib->test3,
            $talib->test4,
            $talib->talib_id,
            $talib->user_id,
            $talib->session_id,
            $talib->created_at,
            $talib->updated_at,
        ];
    }

    public function headings(): array
    {
      
        return [
            'id',
            'test1',
            'test2',
            'test3',
            'test4',
            'talib_id',
            'user_id',
            'session_id',
            'created_at',
            'updated_at',
        ];
    }
}
