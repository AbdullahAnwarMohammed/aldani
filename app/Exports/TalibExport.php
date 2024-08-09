<?php

namespace App\Exports;

use App\Models\Talib;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TalibExport implements FromCollection, WithHeadings
{

  

    public function collection()
    {
        return Talib::select('id','name', 'alhalaqat_id', 'almustawayat_id', 'country_id', 'aldafeuh_id', 'gender', 'date_of_birth', 'phone', 'father_phone', 'cid', 'subscrption','photo','created_at','updated_at')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'alhalaqat_id' => isset($user->alhalaqat->name) ? $user->alhalaqat->name : 'لا يوجد',
                'almustawayat_id' => isset($user->almustawayat->name) ? $user->almustawayat->name : 'لا يوجد',
                'country_id' => isset( $user->country->country_name) ?  $user->country->country_name : 'لا يوجد',
                'aldafeuh_id' => isset($user->aldafeuh->name) ? $user->aldafeuh->name : 'لا يوجد',
                'gender' => $user->gender == 1 ? 'ذكر' : 'انثى',
                'date_of_birth' => $user->date_of_birth,
                'phone' => $user->phone,
                'father_phone' => $user->father_phone,
                'cid' => $user->cid,
                'subscrption' => $user->subscrption === 1 ? "مدفوعة" : "مجاني",
                'photo' => $user->photo,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
        });

    }

   
   

    public function headings(): array
    {
        return [
            'المعرف',
            'الاسم',
            'الحلقة',
            'المستوي',
            'الدولة',
            'الدفعة',
            'الجنس',
            'تاريخ الميلاد',
            'هاتف 1',
            'هاتف 2',
            'الرقم المدني',
            'نوعية الاشتراك',
            'الصورة',
            'تاريخ الانشاء',
            'تاريخ التعديل'
        ];
    }
}
