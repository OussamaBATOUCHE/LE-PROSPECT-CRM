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
            $table->integer('idGrp');
            $table->integer('idChampAct');
            $table->string('societe');
            $table->string('nom');
            $table->string('prenom');
            $table->string('wilaya');
            $table->string('commune');
            $table->string('adresse');
            $table->string('email');
            $table->string('email2');
            $table->string('skype');
            $table->integer('tele1');
            $table->integer('tele2');
            $table->integer('tele3');
            $table->integer('fax');
            $table->string('siteWeb');
            $table->integer('nbreEmplyes');
            $table->longText('description');
            $table->boolean('bloquer');
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
