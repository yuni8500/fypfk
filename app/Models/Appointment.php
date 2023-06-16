<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointment';

    protected $fillable = [
        'id',
        'superviseeID',
        'supervisorID',
        'appointTitle',
        'appointDate',
        'startTime',
        'endTime',
        'purpose',
        'statusAppoint',
        'appointLocation',
        'reasonReject',
    ];
}
