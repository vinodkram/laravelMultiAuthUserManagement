<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraUserField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('trading_account_number')->nullable();
            $table->double('balance',15,2)->nullable();
            $table->double('open_trades')->nullable();
            $table->double('close_trades')->nullable();
            $table->tinyInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');
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
            $table->dropColumn('surname');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('phone_number');
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('trading_account_number');
            $table->dropColumn('balance');
            $table->dropColumn('open_trades');
            $table->dropColumn('close_trades');
            $table->dropColumn('role_id');


        });
    }
}
