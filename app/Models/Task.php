<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'task_name',
        'project',
        'description',
        'assigned_to',
        'priority',
        'status',
        'due_date',
    ];
}