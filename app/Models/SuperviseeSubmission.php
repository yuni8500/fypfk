<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperviseeSubmission extends Model
{
    protected $table = 'superviseesubmission';

    protected $fillable = [
        'id',
        'submissionID',
        'superviseeID',
        'supervisorID',
        'docSubmission',
        'marks',
    ];
}
