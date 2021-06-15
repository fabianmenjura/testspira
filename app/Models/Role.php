<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //relacion para saber cuales usuarios poseen que roles
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
