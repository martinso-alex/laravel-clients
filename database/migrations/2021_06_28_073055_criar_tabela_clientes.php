<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaClientes extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('clientes', function (Blueprint $table) {
      $table->increments('id');
      $table->string('nome');
      $table->string('rg');
      $table->string('cpf');
      $table->date('dt_nascimento');
      $table->string('logradouro');
      $table->integer('numero');
      $table->string('bairro');
      $table->string('municipio');
      $table->string('uf');
      $table->string('foto');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('clientes');
  }
}
