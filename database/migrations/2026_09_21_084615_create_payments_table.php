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
            $table->string('code')->unique();
            $table->decimal('amount', 12, 2);
            $table->date('date');
            $table->string('payment_direction');
            $table->string('payment_method');
            $table->foreignId('payment_category_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('reservation_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('supplier_bill_id')->nullable()->constrained()->restrictOnDelete();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();

            $table->index('reservation_id');
            $table->index('supplier_bill_id');
            $table->index('customer_id');
            $table->index('date');
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
