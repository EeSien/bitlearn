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
        DB::table('questions')->truncate();
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('remember_token');
            $table->json('question')->change();
            $table->json('answer')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->addColumn('varchar','remember_token');
            $table->longText('question')->change();
            $table->longText('answer')->change();
        });
    }
};
