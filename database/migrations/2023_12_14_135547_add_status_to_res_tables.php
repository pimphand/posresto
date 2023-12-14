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
        Schema::table('res_tables', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('description');
            $table->integer('floor')->index()->after('description');
            $table->integer('total_seats')->default(0)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('res_tables', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('floor');
            $table->dropColumn('total_seats');
        });
    }
};
