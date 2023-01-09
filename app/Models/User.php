<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;
   

    protected $fillable = [
        'name',
        'lrn',
        'email',
        'profile',
        'grade',
        'section',
        'contact_number',
        'guardian_name',
        'guardian_contact_number',
        'password',
        'two_factor_code',
        'two_factor_expires_at',
        'isApproved',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
