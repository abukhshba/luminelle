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
        Schema::create('supplier_bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_number')->unique();
            $table->foreignId('supplier_id')->constrained()->restrictOnDelete();
            $table->decimal('total_amount', 12, 2);
            $table->date('bill_date');
            $table->date('delivery_date')->nullable();
            $table->decimal('shipping_fees', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();

            $table->index('supplier_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_bills');
    }
};
