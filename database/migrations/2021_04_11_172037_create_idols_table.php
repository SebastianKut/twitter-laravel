<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdolsTable extends Migration
{
//    Pivot table between users and idols
    public function up()
    {
        Schema::create('idols', function (Blueprint $table) {
            // create index from composite keys (this is for search speed optimisation)
            $table->primary(['user_id', 'idol_user_id']);
            // create fields
            $table->foreignId('user_id');
            $table->foreignId('idol_user_id');
            $table->timestamps();

            //add constrains
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idol_user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idols');
    }
}

//In case of problems with XAMPP 
//host:       '192.168.64.2',
//user:       'username',
//password:   'password',
//Create user and flush privilages
// CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
// GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' WITH GRANT OPTION;
// CREATE USER 'username'@'%' IDENTIFIED BY 'password';
// GRANT ALL PRIVILEGES ON *.* TO 'username'@'%' WITH GRANT OPTION;
// FLUSH PRIVILEGES;