<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    const STATUS_CLOCK_IN = 'clock-in';
    const STATUS_CLOCK_OUT = 'clock-out';

    public $timestamps = true;

    protected $fillable = ['login_dt', 'login_time', 'logout_dt', 'logout_time'];

    protected $guarded = ['id', 'account_id', 'status', 'slug'];
    
    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public static function generateUniqueSlug()
    {
        $newSlug = str_random(16);

        $log = Log::where('slug', $newSlug)->first();
        
        if (!empty($log))  {
            self::generateUniqueSlug();
        }

        return $newSlug;   
    }
}
