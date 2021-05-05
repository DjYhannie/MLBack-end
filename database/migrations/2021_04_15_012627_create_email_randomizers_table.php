<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailRandomizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_randomizers', function (Blueprint $table) {
            $table->id();
            $table->json('emails');
            $table->timestamps();
        });
    }

    // yang wala lage field na user_id ari?
    //algehhh ga libog sad ko
    // ako ni e migrate fresh yang
    //cege
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_randomizers');
    }
}
