<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Talib extends Model
{
    use HasFactory;
    protected $fillable = ['alhalaqat_id', 'almustawayat_id','name', 'gender', 'date_of_birth', 'phone', 'country_id', 'cid','subscrption', 'aldafeuh_id','photo','father_phone'];
    public function alhalaqat()
    {
        return $this->belongsTo(Alhalaqat::class);
    }
    public function almustawayat()
    {
        return $this->belongsTo(Almustawayat::class);
    }

    public function subscrptions()
    {
        return $this->hasMany(Subscrption::class,'talib_id');
    }

  
    public function payments()
    {
        return DB::table('payments')->where('talib_id', $this->id)->get();
    }

    public function payment($subscrption_id)
    {
        return DB::table('payments')->where('talib_id', $this->id)
        ->where('subscrption_id',$subscrption_id)
        ->get();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function aldafeuh()
    {
        return $this->belongsTo(Aldafeuh::class);

    }


    public function degree($date)
    {
        return Tasmie::where('talib_id',$this->id)
        ->where('date',$date)
        ->first();
    }
  

    // function getTotalSubscriptionDays($userId)
    // {
    //     $subscriptions = Subscrption::where('talib_id', $userId)->get();
    
    //     $totalDays = 0;
    
    //     foreach ($subscriptions as $subscription) {
    //         $start_date = Carbon::parse($subscription->reg_start);
    //         $end_date = Carbon::parse($subscription->reg_end);
    
    //         $days = $end_date->diffInDays($start_date);
    
    //         $totalDays += $days;
    //     }
    
    //     return $totalDays;
    // }
    // معرفة المبلغ المالي المدفوع
    public function get_total_count_paid()
    {
        $Count = 0;
        foreach($this->payments() as $Item)
        {
            $Count += $Item->paid_value;
        }
        return $Count;
    }

    public function get_singal_total_count_paid($subscrption_id)
    {
        $Count = 0;
        foreach($this->payment($subscrption_id) as $Item)
        {
            $Count += $Item->paid_value;
        }
        return $Count;
    }

}
