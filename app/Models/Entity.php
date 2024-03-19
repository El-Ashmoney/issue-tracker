<?php

namespace App\Models;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entity extends Model
{
    use HasFactory;

    public function sectors()
    {
        return $this->hasMany(Sector::class);
    }
}