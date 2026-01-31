<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createForCourse(Course $course): Order
    {
        return DB::transaction(function () use ($course) {

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $course->price,
                'status' => 'pending',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'course_id' => $course->id,
                'price' => $course->price,
            ]);

            return $order;
        });
    }
}

