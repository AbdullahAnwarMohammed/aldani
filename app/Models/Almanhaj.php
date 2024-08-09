<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almanhaj extends Model
{
    use HasFactory;
    protected $fillable = ['title','comment','almustawayat_id','part_id'];
    public function almustawayat()
    {
        return $this->belongsTo(Almustawayat::class);
    }

}
