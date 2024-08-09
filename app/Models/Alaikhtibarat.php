<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alaikhtibarat extends Model
{
    use HasFactory;
    protected $fillable = ['test1','test2','test3','test4','talib_id','user_id','session_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function talib()
    {
        return $this->belongsTo(Talib::class);
    }
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
