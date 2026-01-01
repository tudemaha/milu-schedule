<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Request extends Model
{
    use HasUuids;

    protected $fillable = [
        'staff_id',
        'request_id',
        'date'
    ];
}
