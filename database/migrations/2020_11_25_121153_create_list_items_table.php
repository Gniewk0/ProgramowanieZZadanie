<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_list_id')->unsigned()->index();
            $table->string('product_name', 30);
            $table->boolean('is_bought')->default(false);
            $table->timestamps();

            $table->foreign('product_list_id')->references('id')->on('product_lists')->onDelete('cascade');
        });

        // Schema::table('list_items', function($table) {
        //     $table->foreign('product_list_id')->references('id')->on('product_lists');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_items');
    }
}
