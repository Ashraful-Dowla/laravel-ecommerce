<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('pickup_point_id')->after('brand_id');
            $table->integer('product_trendy')->after('product_cash_on_delivery')->default(0);
            $table->integer('product_views')->after('product_cash_on_delivery')->default(0);
            $table->string('product_slider')->after('product_cash_on_delivery')->nullable();
            $table->string('product_color')->after('product_cash_on_delivery')->nullable();
            $table->string('product_size')->after('product_cash_on_delivery')->nullable();
            $table->string('product_slug')->after('product_code')->nullable();
            $table->string('date')->nullable();
            $table->string('month')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('pickup_point_id');
            $table->dropColumn('product_trendy');
            $table->dropColumn('product_views');
            $table->dropColumn('pickup_slider');
            $table->dropColumn('product_color');
            $table->dropColumn('product_size');
            $table->dropColumn('date');
            $table->dropColumn('month');
            $table->dropColumn('product_slug');
        });
    }
}
