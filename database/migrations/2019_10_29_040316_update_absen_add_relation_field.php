<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAbsenAddRelationField extends Migration
{
    
    public function up()
    {
        Schema::table('absen',function(Blueprint $table){
            $table->bigInteger('status_id')->unsigned()->after('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('absen' ,function(Blueprint $table){
            $table->dropForeign('user_id');
            $table->dropForeign('status_id');
            $table->dropColumn('status_id');
        });
    }
}
