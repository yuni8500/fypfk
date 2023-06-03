<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submission';

    protected $fillable = [
        'id',
        'course',
        'title',
        'dueDate',
        'dueTime',
        'linkAttachment',
    ];
}
