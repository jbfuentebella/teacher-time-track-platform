<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempAccount extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_TEACHER = 'teacher';

    const VERIFICATION_PENDING = 'pending';
    const VERIFICATION_VERIFIED = 'verified';
    const VERIFICATION_DONE = 'done'; 

    public $timestamps = true;

    protected $fillable = ['first_name', 'last_name', 'username', 'email'];

    protected $guarded = ['id', 'password', 'role', 'verification_token', 'verification_status'];

    protected $hidden = ['id', 'password', 'remember_token'];

    public static function generateUniqueVerificationToken()
    {
        $newToken = str_random(16);

        $tempAccount = TempAccount::where('verification_token', $newToken)->first();
        
        if (!empty($tempAccount))  {
            self::generateUniqueVerificationToken();
        }

        return $newToken;   
    }
}
