<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $guarded = [];

    public function workers()
    {
        $this->hasMany(Workers::class);
    }
}
