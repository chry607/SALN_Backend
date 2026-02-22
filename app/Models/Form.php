<?php

namespace App\Models;

use App\Traits\TracksFormChanges;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasUuids, SoftDeletes, TracksFormChanges;

    protected $fillable = [
        'user_id',
        'form_data',
        'status',
        'change_history',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'form_data' => 'array',
            'change_history' => 'array',
        ];
    }

    /**
     * Get the user that owns this form
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

