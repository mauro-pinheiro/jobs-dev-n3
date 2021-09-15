<?php

namespace App;

use App\Traits\Sluggable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use Filterable;
    use SoftDeletes;
    use Sluggable;

    protected $sluggableField = 'title';

    protected $fillable = [
        'external_id',
        'title',
        'url',
        'summary'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
