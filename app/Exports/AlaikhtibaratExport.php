<?php

namespace App\Exports;

use App\Models\Alaikhtibarat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlaikhtibaratExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Alaikhtibarat::select('test1','test2','test3','test4','talib_id','user_id','session_id','created_at','updated_at')->get()->map(function($item){
            return [
                'test1' => $item->test1,
                'test2' => $item->test2,
                'test3' => $item->test3,
                'test4' => $item->test4,
                'talib_id' => $item->talib->name,
                'user_id' => $item->user->name,
                'session_id' => $item->session->name,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });
    }
    public function headings(): array
    {
        return [
            'اختبار 1',
            'اختبار 2',
            'اختبار 3',
            'اخبار 4',
            'الطالب',
            'المحفظ',
            'الفصل',
            'تاريخ الانشاء',
            'تاريخ التعديل',
            ];
    }
}
