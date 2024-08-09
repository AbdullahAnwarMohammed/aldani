<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alhalaqat extends Model
{
    use HasFactory;
    protected $fillable = ['name','descrption','user_id','subdivision_id','room_url','type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function talibs()
    {
        return $this->hasMany(Talib::class);
    }
}
