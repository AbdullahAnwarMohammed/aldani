<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admin::select('name', 'email', 'phone', 'showPassword', 'gender', 'male_or_female', 'created_at', 'updated_at')
            ->get()
            ->map(function($item) {
                $male_or_female = null;
                if($item->male_or_female == '[1]') {
                    $male_or_female = "ذكور";
                } elseif($item->male_or_female == '[0]') {
                    $male_or_female = "اناث";
                } else {
                    $male_or_female = "ذكور و اناث";
                }

                return [
                    'name' => $item->name,
                    'email' => $item->email,
                    'phone' => $item->phone,
                    'showPassword' => $item->showPassword,
                    'gender' => $item->gender == 1 ? 'ذكر' : 'انثى',
                    'male_or_female' => $male_or_female,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'الاسم',
            'البريد',
            'الهاتف',
            'كلمة المرور',
            'النوع',
            'الاطلاع علي',
            'تاريخ الانشاء',
            'تاريخ التعديل'
        ];
    }
}
