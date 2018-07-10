<?php

namespace App\Entity;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Workers::class);
    }

    public function specilization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
}
