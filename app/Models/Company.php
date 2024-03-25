<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    // Specify which attributes can be mass assignable
    protected $fillable = ['company_name'];

    // Specify the table if it's not the plural of the model name
    protected $table = 'companies';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'company_id';

    // Enable or disable automatic handling of created_at and updated_at columns
    public $timestamps = true;
}