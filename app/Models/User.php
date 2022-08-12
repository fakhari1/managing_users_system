<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Jobs\SendEmail;
use App\Mail\ResetPassword;
use App\Mail\VerificationEmail;
use App\Services\Authorization\Traits\HasRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Services\Authorization\Traits\HasPermission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermission, HasRole;

    protected $guarded = [];

    public function sendEmailVerificationNotification()
    {
        SendEmail::dispatch($this, new VerificationEmail($this));
    }

    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    public function sendPasswordResetNotification($token)
    {
        SendEmail::dispatch($this, new ResetPassword($this, $token));
    }
}
