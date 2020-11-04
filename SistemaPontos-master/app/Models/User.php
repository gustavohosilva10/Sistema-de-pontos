<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    protected $fillable = [
        "type",
        "name",
        "email",
        "telephone",
        "function",
        "location_work",
        "cpf",
        "bank",
        "agency",
        "account",
        "account_type",
        "password",
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateToken() {

        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
}
