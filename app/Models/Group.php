<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name'];

    // عدد الطلاب
    public function count_of_talibs()
    {
        return TalibInGroup::where('group_id',$this->id)->count();
        
    }
  
}
