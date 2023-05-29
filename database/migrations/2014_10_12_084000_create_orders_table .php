<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('product_id'); // n
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('code');
            $table->bigInteger('price');
            $table->bigInteger('deposit');
            $table->date('reservation_date');
            $table->enum('status' , ['تم الطلب وبإنتظار دفع العربون','تم الحجز ودفع العربون','تم التسليم وانتهاء الحجز'])->nullable()->default('تم الطلب وبإنتظار دفع العربون');
            $table->softDeletes();
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
