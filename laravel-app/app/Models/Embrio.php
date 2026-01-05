<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Embrio extends Model
{
    protected $table = 'embrio';
    protected $primaryKey = 'embrio_id';

    protected $fillable = [
        'embrio_mother_id',
        'embrio_edd',
        'embrio_sex',
    ];

    protected $casts = [
        'embrio_edd' => 'date',
    ];

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Mother::class, 'embrio_mother_id', 'mother_id');
    }

    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class, 'measurement_embrio_id', 'embrio_id')->orderBy('measurement_date');
    }
}
