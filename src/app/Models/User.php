<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail_address',
        'user_password',
        'user_name',
        'user_name_hiragana',
        'telephone_number',
        'nickname',
        'created_at',
        'token',
    ];

    public function getAuthPassword()
    {
        return $this->user_password;
    }
}
