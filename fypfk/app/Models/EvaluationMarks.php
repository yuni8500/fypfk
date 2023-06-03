<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationMarks extends Model
{
    protected $table = 'evaluationmarks';

    protected $fillable = [
        'id',
        'evaluationID',
        'superviseeID',
        'supervisorID',
        'evaluatorName',
        'file',
        'marks',
        'comment',
    ];
}
