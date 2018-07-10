<?php

namespace App;

use App\Entity\Schedule;
use App\Entity\Workers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'second_name',
        'last_name',
        'email',
        'password',
        'phone',
        'image',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function worker()
    {
        return $this->hasOne(Workers::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

}
