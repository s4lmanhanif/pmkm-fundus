<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    protected $table = 'measurement';
    protected $primaryKey = 'measurement_id';

    protected $fillable = [
        'measurement_embrio_id',
        'measurement_date',
        'measurement_height',
    ];

    protected $casts = [
        'measurement_date' => 'date',
    ];

    public function embrio(): BelongsTo
    {
        return $this->belongsTo(Embrio::class, 'measurement_embrio_id', 'embrio_id');
    }
}
