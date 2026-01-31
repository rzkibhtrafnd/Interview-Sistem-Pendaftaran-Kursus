<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\OrderService;
use App\Services\MidtransService;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected MidtransService $midtransService
    ) {}

    public function store(Course $course)
    {
        $order = $this->orderService->createForCourse($course);

        $payment = $this->midtransService->createSnap($order);

        return redirect($payment->snap_redirect_url);
    }
}
