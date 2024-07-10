<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['name','url','alhalaqat_id'];

    public function alhalaqat()
    {
        return $this->belongsTo(Alhalaqat::class);
    }
}
