<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalibInGroup extends Model
{
    use HasFactory;
    protected $fillable = ['talib_id','user_id','group_id'];
}
