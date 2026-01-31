<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CourseMaterial extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'course_id',
        'title',
        'content_url',
        'order_number',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
