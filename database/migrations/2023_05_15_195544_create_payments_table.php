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
                $table->id();
                $table->decimal('amount', 8, 2);
                $table->unsignedBigInteger('user_id');
                $table->enum('payment_method', ['فورى', 'فودافون كاش', 'بطاقة ائتمان'])->default('فودافون كاش');
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('order_id');
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
                $table->softDeletes();
                $table->timestamps();
                
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
