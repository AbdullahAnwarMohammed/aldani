<?php

namespace App\Imports;

use App\Models\Talib;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlhalaqatImport implements ToModel,WithValidation,WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /*`id`, `name`, `descrption`,
         `user_id`, `room_url`, `type`, `created_at`, `updated_at`*/
        return new Talib([
            'id' => $row['id'],
            'name' => $row['name'],
            'descrption' =>$row['descrption'],    
            'user_id' =>$row['user_id'],    
            'room_url' =>$row['room_url'],    
            'type' =>$row['type'],    
            "created_at" => $row['created_at'],
             "updated_at" => $row['updated_at']
        ]);
    }

 

    public function rules(): array
    {
        return [
            'name' => 'required|unique:alhalaqats,name',
         
        ];
    }

}
