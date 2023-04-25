<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supervisorapply extends Model
{
    protected $table = 'supervisorapply';

    protected $fillable = [
        'id',
        'superviseeID',
        'supervisorID',
        'proposedTitle',
        'problemStatement',
        'domain',
        'declaration',
        'dateAgree',
        'statusApplied',
    ];
}
