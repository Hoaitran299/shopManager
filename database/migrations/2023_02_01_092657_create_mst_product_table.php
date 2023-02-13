<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id',20)->index()->unique();
            $table->string('product_name');
            $table->string('product_image')->nullable();
            $table->decimal('product_price')->default(0);
            $table->text('description')->nullable();
            $table->tinyInteger('is_sales')->default(1)->comment('0: Unavailable, 1: Available');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_product');
    }
};
