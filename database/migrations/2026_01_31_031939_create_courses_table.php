<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('category_id');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->enum('status', ['active', 'inactive'])->default('inactive');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
