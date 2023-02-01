<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_admin')->after('is_admin')->default(0)->nullable();
            $table->integer('category')->after('remember_token')->default(0)->nullable();
            $table->integer('product')->after('remember_token')->default(0)->nullable();
            $table->integer('offer')->after('remember_token')->default(0)->nullable();
            $table->integer('order')->after('remember_token')->default(0)->nullable();
            $table->integer('blog')->after('remember_token')->default(0)->nullable();
            $table->integer('pickup')->after('remember_token')->default(0)->nullable();
            $table->integer('ticket')->after('remember_token')->default(0)->nullable();
            $table->integer('contact')->after('remember_token')->default(0)->nullable();
            $table->integer('report')->after('remember_token')->default(0)->nullable();
            $table->integer('setting')->after('remember_token')->default(0)->nullable();
            $table->integer('user_role')->after('remember_token')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_admin');
            $table->dropColumn('category');
            $table->dropColumn('product');
            $table->dropColumn('offer');
            $table->dropColumn('order');
            $table->dropColumn('blog');
            $table->dropColumn('pickup');
            $table->dropColumn('ticket');
            $table->dropColumn('contact');
            $table->dropColumn('report');
            $table->dropColumn('setting');
            $table->dropColumn('user_role');
        });
    }
}
