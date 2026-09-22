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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('customer_id')->constrained()->restrictOnDelete();
            $table->date('reservation_date');
            $table->date('delivery_date');
            $table->date('return_date');
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->string('discount_type')->nullable();
            $table->decimal('discount_value', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('insurance_amount', 12, 2)->default(0);
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();

            $table->index('customer_id');
            $table->index('status');
            $table->index(['delivery_date', 'return_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
