<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id');
            $table->uuid('user_id');

            $table->string('midtrans_order_id')->unique();
            $table->string('transaction_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();

            $table->decimal('gross_amount', 12, 2);
            $table->string('currency')->default('IDR');

            $table->string('transaction_status')->nullable();
            $table->string('fraud_status')->nullable();

            $table->enum('status', ['PENDING','PAID','FAILED','EXPIRED','REFUNDED'])->default('PENDING');

            $table->string('snap_token')->nullable();
            $table->text('snap_redirect_url')->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();

            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
