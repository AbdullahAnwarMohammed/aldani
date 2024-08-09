<?php

namespace App\Exports;

use App\Models\Talib;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TalibExportSQL implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Talib::all();
    }

    public function map($talib): array
    {
        return [
            $talib->id,
            $talib->alhalaqat ? $talib->alhalaqat->id : null,
            $talib->almustawayat ? $talib->almustawayat->id : null,
            $talib->country ? $talib->country->id : null,
            $talib->aldafeuh ? $talib->aldafeuh->id : null,
            $talib->name,
            $talib->gender == 1 ? '1' : '0',
            $talib->date_of_birth,
            $talib->phone,
            $talib->father_phone,
            $talib->cid,
            $talib->subscrption === 1 ? "1" : "0",
            $talib->photo,
            $talib->created_at ? $talib->created_at->format('Y-m-d H:i:s') : null,
            $talib->updated_at ? $talib->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }


    public function headings(): array
    {
        return [
            'ID',
            'Alhalaqat',
            'Almustawayat',
            'Country',
            'Aldafeuh',
            'Name',
            'Gender',
            'Date of Birth',
            'Phone',
            'Father Phone',
            'CID',
            'Subscription',
            'Photo',
            'Created At',
            'Updated At',
        ];
    }

}
