<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasmie extends Model
{
    use HasFactory;
    protected $fillable = ['talib_id', 'attend','user_id', 'part_id','alhalaqat_id', 'almanhaj_id','session_id', 'number_of_quarters', 'degree', 'comment', 'date'];

    public function talib()
    {
        return $this->belongsTo(Talib::class);
    }

    public function alhalaqat()
    {
        return $this->belongsTo(Alhalaqat::class);
    }

    
  public function part()
  {
    return $this->belongsTo(Part::class);
  }
  
  public function almanhaj(){
    return $this->belongsTo(Almanhaj::class);

  }

  public function users(){
    return $this->hasMany(User::class);
  }

}
