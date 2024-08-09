<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminExportSQL  implements FromCollection, WithHeadings, WithMapping
{
    /*
`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `showPassword`, `gender`,
 `male_or_female`, `remember_token`, `created_at`, `updated_at
    */
    public function collection()
    {
        return Admin::all();
    }
    public function map($user): array
    {

        return [
            $user->id,
            $user->name,
            $user->email,
            $user->email_verified_at,
            $user->password,
            $user->phone,
            $user->showPassword,
            $user->gender,
            $user->male_or_female,
            $user->remember_token,
            $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : null,
            $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }

    public function headings(): array
    {
        return [
            'id', // ID
            'name', // Name
            'email', // Email
            'email_verified_at', // Email Verified At
            'password', // Password
            'phone', // Phone
            'showPassword', // Show Password
            'gender', // Gender
            'male_or_female', // Not listed, assuming this is related to Gender
            'remember_token', // Remember Token
            'created_at', // Created At
            'updated_at', // Updated At
        ];
    }
}
