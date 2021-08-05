<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('achievementRequirements')) {
            Schema::create('achievementRequirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('achievement_id');
            $table->foreign('achievement_id')->references('id')->on('achievements');
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('recyclingmaterial');
            $table->integer('count');
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
        Schema::dropIfExists('achievementRequirements');
    }
}
