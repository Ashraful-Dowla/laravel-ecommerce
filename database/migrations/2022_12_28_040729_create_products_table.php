<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->integer('childcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_unit')->nullable();
            $table->string('product_tags')->nullable();
            $table->string('product_video')->nullable();
            $table->string('product_purchase_price')->nullable();
            $table->string('product_selling_price')->nullable();
            $table->string('product_discount_price')->nullable();
            $table->string('product_stock_quantity')->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->string('product_images')->nullable();
            $table->integer('product_featured')->nullable();
            $table->integer('product_status')->nullable();
            $table->integer('product_today_deal')->nullable();
            $table->integer('product_cash_on_delivery')->nullable();
            $table->integer('flash_deal_id')->nullable();
            $table->integer('warehouse')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
