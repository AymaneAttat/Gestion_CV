<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.->format('Y/m/d')
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();//->unique()
            $table->string('prenom', 30)->nullable();
            $table->string('nom', 30)->nullable();
            $table->string('telephone')->nullable();
            $table->date('date_debut_experience')->nullable();
            $table->longText('formation')->nullable();
            $table->string('skill1', 50)->nullable();
            $table->string('skill2', 50)->nullable();
            $table->string('skill3', 50)->nullable();
            $table->string('skill4', 50)->nullable();
            $table->string('skill5', 50)->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
