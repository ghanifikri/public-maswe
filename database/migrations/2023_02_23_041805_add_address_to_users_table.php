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
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address')->nullable();
            $table->integer('provinces_id')->default(0);
            $table->integer('regencies_id')->default(0);
            $table->integer('districts_id')->default(0);
            $table->string('phone_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('provinces_id');
            $table->dropColumn('regencies_id');
            $table->dropColumn('districts_id');
            $table->dropColumn('villages_id');
            $table->dropColumn('phone_number');
        });
    }
};
