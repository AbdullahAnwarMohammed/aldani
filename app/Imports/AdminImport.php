<?php

namespace App\Imports;

use App\Models\Admin;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AdminImport implements ToModel,WithValidation,WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        dd($row);
        $dateOfBirth = $this->convertToDate($row['date_of_birth']);

        return new Admin([
            'id' => $row['id'],
            'name' => $row['name'],
            'alhalaqat_id' => $row['alhalaqat'],
            'almustawayat_id' => $row['almustawayat'],
            'country_id' => $row['country'],
            'aldafeuh_id' => $row['aldafeuh'],
            'gender' => $row['gender'] == 'ذكر' ? 1 : 0,
            'date_of_birth' => $dateOfBirth,
            'phone' => $row['phone'],
            'father_phone' => $row['father_phone'],
            'cid' => $row['cid'],
            'subscrption' =>$row['subscription'],    
            "created_at" => $row['created_at'],
             "updated_at" => $row['updated_at']
        ]);
    }

    private function convertToDate($date)
    {
        try {
            // Adjust the format as necessary
            return Carbon::createFromFormat('Ymd', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Handle the exception if the date is not in the expected format
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:admins,email'],
        ];
    }

}
