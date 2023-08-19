<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ApiToken extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'personal_access_id',
        'api_tokens',
    ];
}