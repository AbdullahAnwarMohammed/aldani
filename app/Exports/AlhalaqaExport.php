<?php

namespace App\Exports;

use App\Models\Alhalaqat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlhalaqaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alhalaqat::select('name', 'descrption','user_id','room_url','type','created_at','updated_at')->get()->map(function($item){
            return [
                'id' => $item->id,
                'descrption' => $item->descrption,
                'user_id' => $item->user->name,
                'room_url' => $item->room_url,
                'type' => $item->type == 1 ? 'ذكر' : 'انثى',
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });
    }
    public function headings(): array
    {
        return [
            'المعرف',
            'الوصف',
            'المحفظ',
            'الغرفة',
            'النوع',
            'تاريخ الانشاء',
            'تاريخ التعديل',
        ];
    }
}
