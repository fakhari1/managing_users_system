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
    protected $appends = ['roles_labels'];

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

    public function getRolesLabelsAttribute()
    {
        $labels = "<div class='d-flex justify-content-center flex-wrap'>";
        foreach ($this->roles as $key => $role) {
            $tag = "<span class='btn btn-sm btn-outline-primary my-1 mx-1 w-60-px'>{$role->persian_name}</span>";
            $labels .= $tag;
        }
        $labels .= "</div>";
        return $labels;
    }
}
