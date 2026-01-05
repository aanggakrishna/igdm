<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IgRowMessage extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'message',
        'timestamp',
    ];
}
