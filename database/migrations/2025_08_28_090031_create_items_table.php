<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code_item', 100)->index();
            $table->string('item_name', 100)->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('stock')->index()->default(0);
            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('updated_by')->index()->nullable()->default(null);
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
        Schema::dropIfExists('items');
    }
}
