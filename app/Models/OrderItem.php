<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'order_id',
        'course_id',
        'price',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
