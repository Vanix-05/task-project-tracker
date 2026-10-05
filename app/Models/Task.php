<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
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