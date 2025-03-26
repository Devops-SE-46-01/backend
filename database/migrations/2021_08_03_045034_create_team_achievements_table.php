<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->integer('id_achievement');
            $table->string('name');
            $table->string('nim');
            $table->string('major');
            $table->integer('generation');
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
        Schema::dropIfExists('team_achievements');
    }
}
