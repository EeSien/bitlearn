<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('last_visited')->after('remember_token')->nullable();
            $table->string('uid')->after('id')->nullable();
            $table->string('first_name')->after('uid');
            $table->string('last_name')->after('first_name');
            $table->string('username')->after('last_name');
            $table->integer('phone')->after('email');
            $table->bigInteger('balance')->after('phone')->default(0);
            $table->string('referral')->after('balance')->nullable(true);
            $table->integer('progress')->after('referral')->default(0);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
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
            $table->dropColumn('last_visited');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('balance');
            $table->dropColumn('referral');
            $table->dropColumn('progress');
        });

    }
};
