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
        Schema::create('project_showcase', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('team_name');
            $table->string('team_members');
            $table->string('proposal');
            $table->string('prd');
            $table->string('figma');
            $table->string('github');
            $table->text('about');
            //images
            $table->string('thumbnail')->nullable();;
            $table->string('qr')->nullable();;
            $table->string('design_system');

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
        Schema::dropIfExists('project_showcase');
    }
};
