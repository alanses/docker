<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class PositionHeld extends Model
{
    protected $guarded = [];

    public function workers()
    {
        $this->hasMany(Workers::class);
    }
}
