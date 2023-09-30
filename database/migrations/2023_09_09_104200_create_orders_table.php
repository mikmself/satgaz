<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('owner_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('bouquet_id')->nullable()
                                            ->constrained('bouquets')
                                            ->onUpdate('cascade')
                                            ->onDelete('cascade');
            $table->foreignUuid('bouquet_custom_id')
                                            ->nullable()
                                            ->constrained('bouquet_customs')
                                            ->onUpdate('cascade')
                                            ->onDelete('cascade');
            $table->json('toppings')->nullable();
            $table->integer('total_price');
            $table->integer('total_order');
            $table->string('dp_image')->nullable();
            $table->string('repayment_image')->nullable();
            $table->string('order_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
