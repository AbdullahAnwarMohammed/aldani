<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['name_site', 'logo_small','logo_big', 'favicon_site', 'email_site', 'phone',
     'status_site', 'login_almuhfazin', 'facebook_site', 'twitter_site', 
     'youtube_site', 'instgram_site', 'address', 'maps', 'message_close_site', 'year'];

     public function session()
     {
        return $this->belongsTo(Session::class);
     }
    public static function checkSetting()
    {
        $Settings = Self::all();
        if (count($Settings) < 1) {
            Setting::create([
                'name_site' => 'اسم الموقع'
            ]);
        }

        return Self::first();

    }
}
