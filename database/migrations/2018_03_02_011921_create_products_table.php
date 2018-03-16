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
        if(!Schema::hasTable('products')){
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('category_id')->unsigned();
                $table->integer('lm')->unsigned();
                $table->char('name');
                $table->boolean('free_shipping');
                $table->char('description');
                $table->float('price',10,2);
                $table->timestamps();
            });
            Schema::table('products', function (Blueprint $table) {
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('products')){
            Schema::table('products', function(Blueprint $table){
                //$table->dropForeign(['category_id']);
            });
            Schema::dropIfExists('products');
        }
    }
}
