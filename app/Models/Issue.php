<?php

namespace App\Models;

use App\Models\Sector;
use App\Models\Company;
use App\Models\IssueOwner;
use App\Models\IssueAssignee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory;

    protected $primaryKey = 'issue_id';

    public $timestamps = true;

    protected $fillable = [
        'created_by',
        'issue_description',
        'sector_id',
        'owner_id',
        'assignee_id',
        'scale',
        'company_id',
        'time_duration',
        'issue_date',
        'source',
        'status',
        'azure_status',
        'resolved_at',
    ];

    protected $appends = ['time_duration'];
    public function getTimeDurationAttribute()
    {
        if ($this->resolved_at) {
            return $this->created_at->diffForHumans($this->resolved_at, true, true, 2);
        }
        return 'Not resolved yet';
    }


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

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
}