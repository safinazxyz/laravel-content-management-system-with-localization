<?php

namespace App\Models;
use App\Notifications\admin\auth\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
    protected $guard = 'admin';
    protected  $fillable = [
        'name',
        'type',
        'mobile',
        'email',
        'password',
        'image',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $hidden = [
        'password','remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}
