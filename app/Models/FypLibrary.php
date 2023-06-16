<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FypLibrary extends Model
{
    protected $table = 'fyplibrary';

    protected $fillable = [
        'id',
        'submissionID',
        'superviseeID',
        'projectTitle',
        'abstract',
        'fileProject',
    ];
}
