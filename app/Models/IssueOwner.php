<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueOwner extends Model
{
    use HasFactory;
    protected $fillable = ['owner_name'];

    protected $table = 'issue_owners';

    protected $primaryKey = 'owner_id';

    public $incrementing = true;

    protected $keyType = 'int';
}
