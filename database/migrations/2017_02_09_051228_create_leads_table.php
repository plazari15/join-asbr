<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $this->string('nome');
            $this->string('email');
            $this->string('telefone');
            $table->enum('regiao', ['Norte', 'Nordeste', 'Sul', 'Sudeste', 'Centro-Oeste']);
            $table->enum('unidade', ["Porto Alegre", "Curitiba", "São Paulo", "Rio de Janeiro", "Belo Horizonte", "Brasília", "Salvador", "Recife", "INDISPONÍVEL"]);
            $table->date('data_nascimento');
            $table->integer('score');
            $this->string('token');
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
        Schema::drop('leads');
    }
}
