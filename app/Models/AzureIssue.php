<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzureIssue extends Model
{
    use HasFactory;
    // Specify which attributes can be mass assignable
    protected $fillable = [
        'work_item_id',
        'project',
        'issue_type',
        'title',
        'description',
        'added_by',
        'created_by',
        'resolved_by',
        'status',
        'priority',
        'discipline',
        'teams',
        'source',
        'worked_time',
        'description_of_close',
        'created_date',
    ];

    // Specify the table if it's not the plural of the model name
    protected $table = 'azure_issues';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'work_item_id';

    // Enable or disable automatic handling of created_at and updated_at columns
    public $timestamps = true;
}
