<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codeProsp');
            $table->integer('idGrp')->nullable();
            $table->integer('idChampAct');
            $table->string('societe');
            $table->string('adresse');
            $table->integer('codePostal')->nullable();
            $table->string('wilaya');
            $table->string('genre');
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('email');
            $table->string('skype')->nullable();
            $table->integer('tele1');
            $table->integer('tele2')->nullable();
            $table->integer('tele3')->nullable();
            $table->integer('fax')->nullable();
            $table->string('siteWeb')->nullable();
            $table->integer('nbreEmplyes')->nullable();
            $table->longText('description');
            $table->boolean('bloquer');
            $table->boolean('client');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospects');
    }
}
