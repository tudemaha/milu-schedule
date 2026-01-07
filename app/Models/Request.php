<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'employee_id',
        'type_id',
        'date',
        'reason',
    ];

    public function employee(): BelongsTo {
        return $this->belongsTo(Employee::class);
    }
}
