<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $primaryKey = 'issue_id';

    public $timestamps = true;

    protected $fillable = [
        'created_by',
        'issue_description',
        'owner_id',
        'assignee_id',
        'scale',
        'company_id',
        'time_duration',
        'issue_date',
        'status',
        'azure_status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function owner()
    {
        return $this->belongsTo(IssueOwner::class, 'owner_id', 'owner_id');
    }

    public function assignee()
    {
        return $this->belongsTo(IssueAssignee::class, 'assignee_id', 'assignee_id');
    }

    public function creator(){
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
