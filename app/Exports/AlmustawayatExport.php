<?php

namespace App\Exports;

use App\Models\Almustawayat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlmustawayatExport implements   FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Almustawayat::select('name','comment','created_at','updated_at')->get()->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'comment' => $item->comment,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
             
                ];
        });
    }
    public function headings(): array
    {
        return [
            'المعرف',
            'الاسم',
            'الملاحظات',
            'تاريخ الانشاء',
            'تاريخ التعديل'
          
        ];
    }
}
