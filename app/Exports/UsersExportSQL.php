<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExportSQL implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::all();
    }

    public function map($user): array
    {

        return [
            $user->id,
            $user->name,
            $user->email,
            $user->email_verified_at,
            $user->password,
            $user->gender ? $user->gender : "0",
            $user->showPassword,
            $user->phone,
            $user->cid,
            $user->date_of_birth,
            $user->photo,
            $user->test ? $user->test : "0",
            $user->remember_token,
            $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : null,
            $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Email Verified At',
            'Password',
            'Gender',
            'Show Password',
            'Phone',
            'CID',
            'Date of Birth',
            'Photo',
            'Test',
            'Remember Token',
            'Created At',
            'Updated At',
        ];
    }
}
