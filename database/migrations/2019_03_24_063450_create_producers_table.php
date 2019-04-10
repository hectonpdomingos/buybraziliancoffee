<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // owner, full_address, state, email, phone, Razão Social, Nome Fantasia:, cnpj, is, im, about_producer
        Schema::create('producers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('owner');
            $table->string('address')->nullable(); //address + number + neibour
            $table->integer('number')->nullable();
            $table->string('state')->nullable();
            $table->integer('zipcode')->nullable(); //cep
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('phone2')->nullable();
            $table->string('cnpj')->nullable(); // Cadastro Nacional da Pessoa Jurídica.
            $table->string('cpf')->nullable(); //CPF
            $table->string('rs')->nullable(); //razão social
            $table->string('nf')->nullable(); //nome fantasia
            $table->string('ie')->nullable(); //inscrição estadual
            $table->string('im')->nullable(); //inscrição municipal
            $table->string('about_producer')->nullable();
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
        Schema::dropIfExists('producers');
    }
}
