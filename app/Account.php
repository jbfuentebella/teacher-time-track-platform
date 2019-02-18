<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;

    const STATUS_INACTIVE = 'inactive';
    const STATUS_ACTIVE = 'active';
    const STATUS_LOCKED = 'locked';

    const ROLE_ADMIN = 'admin';
    const ROLE_TEACHER = 'teacher';

    public $timestamps = true;

    protected $fillable = ['first_name', 'last_name', 'username', 'email'];

    protected $guarded = ['id', 'temp_account_id', 'password', 'role', 'verification_token', 'verification_status'];

    protected $hidden = ['id', 'password', 'remember_token'];

    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    public function isTeacher()
    {
        return $this->role == self::ROLE_TEACHER;
    }

    public function getLogLatestRecordStatus()
    {
        $log = self::getLastestLogRecord();

        if (!empty($log)) {
            return $log->status;
        }

        return null;
    }

    public function logs()
    {
        return $this->hasMany('App\Log');
    }


    public static function getLastestLogRecord()
    {
        return auth()->user()->logs()
            ->orderBy('id', 'desc')
            ->first();
    }

    public static function generateUniqueSlug()
    {
        $newSlug = str_random(16);

        $account = Account::where('slug', $newSlug)->first();
        
        if (!empty($account))  {
            self::generateUniqueSlug();
        }

        return $newSlug;   
    }

    
}
