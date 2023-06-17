<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

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

    public function user()
{
    return $this->belongsTo(User::class, 'superviseeID', 'id');
}

public function supervisor()
{
    return $this->belongsTo(User::class, 'supervisorID', 'id');
}

}
