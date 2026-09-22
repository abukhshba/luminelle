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
        Schema::create('dresses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->decimal('rental_price', 12, 2);
            $table->decimal('selling_price', 12, 2)->nullable();
            $table->string('status')->default('available');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('supplier_id');
            $table->index('category_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dresses');
    }
};
