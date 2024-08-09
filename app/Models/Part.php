<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $fillable = ['title','comment','almustawayat_id'];


    // public function parts()
    // {
    //     return $this->belongsToMany(Part::class);
    // }

    
    public function almanhajs()
    {
        return $this->hasMany(Almanhaj::class);
    }
}
