<?php

namespace App\Models;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entity extends Model
{
    use HasFactory;
    // Specify which attributes can be mass assignable
    protected $fillable = ['name'];

    // Specify the table if it's not the plural of the model name
    protected $table = 'entities';

    // Enable or disable automatic handling of created_at and updated_at columns
    public $timestamps = true;

    public function sectors()
    {
        return $this->hasMany(Sector::class);
    }
}