<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'username',
        'nik',
        'gender_id',
        'department_id',
        'status_id',
        'jabatan_id',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gender(){
        return $this->belongsTo('App\Models\Gender');
    }

    public function jabatan(){
        return $this->belongsTo('App\Models\jabatan');
    }
    public function department(){
        return $this->belongsTo('App\Models\department');
    }
    public function status(){
        return $this->belongsTo('App\Models\Status');
    }
    public function unit(){
        return $this->belongsTo('App\Models\Unit');
    }
}
