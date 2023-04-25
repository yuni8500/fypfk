<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logbook extends Model
{
    protected $table = 'logbook';

    protected $fillable = [
        'id',
        'superviseeID',
        'supervisorID',
        'weekLog',
        'dateLog',
        'timeStart',
        'timeEnd',
        'progress',
        'comment',
        'approval',
    ];
}
