<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasmie extends Model
{
    use HasFactory;
    protected $fillable = ['talib_id', 'attend', 'part_id', 'almanhaj_id', 'number_of_quarters', 'degree', 'comment', 'date'];

    public function talib()
    {
        return $this->belongsTo(Talib::class);
    }

  public function part()
  {
    return $this->belongsTo(Part::class);
  }
  
  public function almanhaj(){
    return $this->belongsTo(Almanhaj::class);

  }

}
