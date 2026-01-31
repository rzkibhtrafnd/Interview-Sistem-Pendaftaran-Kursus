<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function materials()
    {
        return $this->hasMany(CourseMaterial::class);
    }
}
