<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluation';

    protected $fillable = [
        'id',
        'superviseeID',
        'supervisorID',
        'evaluator1',
        'evaluator2',
        'dateEvaluate',
        'timeEvaluate',
        'location',
        'linkFile',
    ];
}
