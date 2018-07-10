<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function workers()
    {
        $this->hasMany(Workers::class);
    }
}
