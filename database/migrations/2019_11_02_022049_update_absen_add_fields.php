<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAbsenAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absen',function(Blueprint $table){
            $table->date('date')->after('status_id');
            $table->string('nama')->after('date');
            $table->string('email')->after('nama');
            $table->time('time_in')->after('email');
            $table->time('time_out')->after('time_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absen', function(Blueprint $table){
            $table->DropColumn('date');
            $table->DropColumn('nama');
            $table->DropColumn('email');
            $table->DropColumn('time_in');
            $table->DropColumn('time_out');
        });
    }
}
