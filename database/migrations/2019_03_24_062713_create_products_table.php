<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->string('product_code')->unique();
            $table->string('ean')->nullable();
            $table->integer('producer_id');
            $table->double('weight');
            $table->string('photo');
            $table->integer('stock');
            $table->decimal('cost', 8, 2);  //100000,99
            $table->decimal('price', 8, 2);  //100000,99
            $table->string('about_coffee')->nullable();
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
        Schema::dropIfExists('products');
    }
}


