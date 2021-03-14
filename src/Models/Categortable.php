<?php

namespace Habib\Categortable\Models;

use Habib\Categortable\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Categortable extends MorphPivot
{
    use UuidTrait;

    const CATEGORTABLE = 'categortable';

    protected  $table='categortables';
    protected $fillable=[
        'id',
        'category_id',
        'categortables_id',
        'categortables_type',
    ];

    public function categortable()
    {
        return $this->morphTo();
    }
}
