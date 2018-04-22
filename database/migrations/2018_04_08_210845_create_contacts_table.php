<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser');
            $table->integer('idTach');
            $table->integer('idProsp');
            $table->integer('idScore');
            $table->date('date');
            $table->longText('remarque');
            $table->enum('type', ['A', 'E','T']); //sa va me servire pour le updateContact Modal
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
