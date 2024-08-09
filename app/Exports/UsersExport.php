<?php

namespace App\Exports;

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{


    public function collection()
    {   
    
        return User::select('id','name', 'email','gender','showPassword','phone','cid','date_of_birth','test')->get()->map(function($user){
        
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'gender' =>$user->gender == 1 ? 'ذكر' : 'انثى',
                'showPassword' => $user->showPassword,
                'phone' => $user->phone,
                'cid' => $user->cid,
                'date_of_birth' => $user->date_of_birth,
                'test' => $user->test == 1 ? 'مفعل' : 'غير مفعل',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'المعرف',
            'الاسم',
            'البريد',
            'الجنس',
            'كلمة المرور',
            'الهاتف',
            'الرقم المدني',
            'تاريخ الميلاد',
            'الاختبارات',
        ];
    }
}
