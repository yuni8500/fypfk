<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoprofile extends Model
{
    protected $table = 'infoprofile';

    protected $fillable = [
        'id',
        'userID',
        'course',
        'expertGroup',
    ];
}
