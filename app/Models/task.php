<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table = 'task';

    protected $fillable = [
        'id',
        'superviseeID',
        'titleTask',
        'assignor',
        'dueDate',
        'priority',
        'status',
        'taskDetails',
        'progress',
        'attachment',
        'comment',
        'supervisorAttachment',
    ];
}
