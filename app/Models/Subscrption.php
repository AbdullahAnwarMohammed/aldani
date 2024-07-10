<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscrption extends Model
{
    use HasFactory;
    protected $fillable = ['talib_id','reg_start','reg_end','required_value'];

    public function subscrption()
    {
        return $this->belongsTo(Talib::class,'talib_id');
    }

   
    public function payments()
    {
        return DB::table('payments')->where('subscrption_id', $this->id)->get();
    }


    public function total_payments()
    {
        $payments =  DB::table('payments')->where('subscrption_id', $this->id)->get();
        $total = 0;
        foreach($payments as $item)
        {
            $total+= $item->paid_value;
        }
        return $total;
    }

    // المتبقي
    public function Residual()
    {
        return $this->required_value - $this->total_payments();
    }
}
