<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mother extends Model
{
    protected $table = 'mother';
    protected $primaryKey = 'mother_id';

    protected $fillable = [
        'mother_name',
        'mother_address',
        'mother_etnis',
        'mother_parity',
        'mother_weight',
        'mother_height',
    ];

    public function embrio(): HasOne
    {
        return $this->hasOne(Embrio::class, 'embrio_mother_id', 'mother_id');
    }

    public function measurements(): HasManyThrough
    {
        return $this->hasManyThrough(
            Measurement::class,
            Embrio::class,
            'embrio_mother_id',
            'measurement_embrio_id',
            'mother_id',
            'embrio_id'
        );
    }
}
