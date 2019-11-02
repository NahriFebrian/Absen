<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersAddPasswordField extends Migration
{
    
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->string('password')->after('email');
        });
    }

    
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->DropColumn('password');
        });
    }
}
