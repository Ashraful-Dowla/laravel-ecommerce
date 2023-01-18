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
            $table->string('order_id');
            $table->string('c_name');
            $table->string('c_phone');
            $table->string('c_phone_2')->nullable();
            $table->string('c_email');
            $table->string('c_country');
            $table->string('c_city');
            $table->string('c_zipcode');
            $table->text('c_address');
            $table->text('c_address_2')->nullable();
            $table->string('subtotal');
            $table->string('total');
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('after_discount');
            $table->string('payment_type')->nullable();
            $table->string('tax');
            $table->string('shipping_charge', 5);
            $table->integer('status')->default(0);
            $table->string('date');
            $table->string('month');
            $table->string('year');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
