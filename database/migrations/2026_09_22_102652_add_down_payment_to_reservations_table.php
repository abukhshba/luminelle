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
        Schema::table('reservations', function (Blueprint $table) {
            $table->decimal('down_payment', 12, 2)->default(0)->after('insurance_amount');
            $table->decimal('remaining_amount', 12, 2)->default(0)->after('down_payment');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['down_payment', 'remaining_amount']);
        });
    }
};
