<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecycleditemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('recycleditems')) {
            Schema::create('recycleditems', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('item_name');
            $table->foreignId('userid');
            $table->integer('item_count');
            
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
        Schema::dropIfExists('recycleditems');
    }
}
