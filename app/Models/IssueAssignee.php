<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueAssignee extends Model
{
    use HasFactory;
    protected $fillable = ['assignee_name'];

    protected $table = 'issue_assignees';

    protected $primaryKey = 'assignee_id';

    public $incrementing = true;

    protected $keyType = 'int';
}