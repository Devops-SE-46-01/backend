<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('nim');
            $table->string('major');
            $table->string('generation');
            $table->string('division');
            $table->boolean('is_accepted');
            $table->string('cv');
            $table->string('portofolio')->nullable();
            $table->string('motivation_letter');
            $table->string('ksm');
            $table->string('share_poster');
            $table->string('whatsapp');
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
        Schema::dropIfExists('recruitations');
    }
}
