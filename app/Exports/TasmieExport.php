<?php

namespace App\Exports;

use App\Models\Tasmie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasmieExport implements FromCollection, WithHeadings 
{
    public function collection()
    {
        return Tasmie::select('talib_id','user_id','attend','part_id','almanhaj_id','number_of_quarters','degree','comment','date','created_at','updated_at')->get()->map(function($user){
            return [
                'talib_id' => $user->talib->name,
                'user_id' => $user->users->name,
                'attend' => $user->users,
                 'part_id' => $user->part->name,
                 'almanhaj_id' => $user->almanhaj->name,
                 'number_of_quarters' => $user->number_of_quarters,
                  'degree' => $user->degree,
                  'comment' => $user->comment,
                  'date' => $user->date,
                  'created_at' => $user->created_at,
                  'updated_at' => $user->updated_at,
                  ];
        });
    }
    public function headings(): array
    {
        return [
            'المعرف',
            'الطالب',
            'المحفظ',
            'الحضور',
             'الجزء',
             'المهنج',
             'عدد الاباع',
             'الدرجة',
             'الملاحظة',
             'التاريخ',
            'تاريخ الانشاء',
            'تاريخ التعديل'
          
        ];
    }
}
