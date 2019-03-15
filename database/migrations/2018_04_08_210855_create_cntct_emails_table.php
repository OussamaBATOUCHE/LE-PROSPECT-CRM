<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCntctEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cntct_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCntct');
            $table->integer('idGrp');
            $table->longText('contenu');
            $table->enum('envoye', ['Oui', 'Non']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cntct_emails');
    }
}
