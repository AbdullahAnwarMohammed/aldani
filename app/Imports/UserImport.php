<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel,WithValidation, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $dateOfBirth = $this->convertToDate($row['date_of_birth']);
        return new User([
            'id' => $row['id'],
            'name' => $row['name'],
            'email' =>  $row['email'],
            'email' =>  $row['email_verified_at'],
            'email' =>  $row['email'],
            'password' => $row['password'],
            'gender' => $row['gender'],
            'showPassword' => $row['show_password'],
            'phone' => $row['phone'],
            'cid' => $row['cid'],
            'date_of_birth' => $dateOfBirth,
            'photo' => $row['photo'],
            'test' => $row['test'],
            'remember_token' => $row['remember_token'],
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
            'phone' => ['numeric'],
            'cid' => 'required|unique:users,cid|digits:12|numeric'
        ];
    }
}
