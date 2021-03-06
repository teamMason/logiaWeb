<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('role',
                [ 'administrador', 'secretario', 'tesorero', 'venerable', 'maestro', 'companero', 'aprendiz' ]);
            $table->enum('estado', [ 'RECHAZADO', 'ACTIVO','BAJA','PENDIENTE']);
            $table->integer('id_taller')->unique();
            $table->string('token')->nullable();
            $table->string('ciudad', 30);
            $table->rememberToken();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *s\
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
