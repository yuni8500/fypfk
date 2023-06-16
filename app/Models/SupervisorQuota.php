<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorQuota extends Model
{
    protected $table = 'supervisorquota';

    protected $fillable = [
        'id',
        'supervisorID',
        'quota',
    ];
}
