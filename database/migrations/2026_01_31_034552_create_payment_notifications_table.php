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
        Schema::create('payment_notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('payment_id');

            $table->string('midtrans_order_id');
            $table->string('transaction_status');
            $table->string('fraud_status')->nullable();

            $table->json('payload');
            $table->timestamp('received_at');

            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_notifications');
    }
};
