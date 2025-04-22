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
        Schema::table('recruitations', function (Blueprint $table) {
            $table->string('yt_evidence')->after('share_poster');
            $table->string('linkedin_evidence')->after('yt_evidence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitations', function (Blueprint $table) {
            $table->dropColumn('yt_evidence');
            $table->dropColumn('linkedin_evidence');
        });
    }
};
