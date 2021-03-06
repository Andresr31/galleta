<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookiesTable extends Migration
{
    /**
     * Run the migrations.
     * crea la tabla
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cookies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla cookies
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cookies');
    }
}
