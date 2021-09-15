<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

trait Sluggable
{
    public static function bootSluggable()
    {
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'slug')) {
                $model->slug = Str::slug($model->getSlugglebleFieldValue());
            }
        });

        static::updating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'slug')) {
                $model->slug = Str::slug($model->getSlugglebleFieldValue());
            }
        });
    }

    public static function findBySlug($value, $orFail = true)
    {
        $value = Str::slug("$value");
        return $orFail
            ? self::where('slug', $value)->firstOrFail()
            : self::where('slug', $value)->first();
    }

    public function getSlugglebleField()
    {
        return $this->sluggableField;
    }

    public function getSlugglebleFieldValue()
    {
        return $this->{$this->getSlugglebleField()};
    }
}
