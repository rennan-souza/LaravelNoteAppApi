<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject; // Import JWT
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'password',
    ];
  
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'is_admin' => $this->is_admin
            ]
        ];
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
