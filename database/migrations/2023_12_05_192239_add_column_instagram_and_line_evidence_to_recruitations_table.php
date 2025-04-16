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
            $table->string('instagram_evidence')->after('yt_evidence');
            $table->string('line_evidence')->after('instagram_evidence');
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
            $table->dropColumn('instagram_evidence');
            $table->dropColumn('line_evidence');
        });
    }
};
