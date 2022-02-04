<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('prenom', 20);
            $table->string('nom', 20);
            $table->string('telephone', 20);
            $table->date('date_debut_experience');
            $table->string('formation', 100);
            $table->string('skill1', 40);
            $table->string('skill2', 40)->nullable();
            $table->string('skill3', 40)->nullable();
            $table->string('skill4', 40)->nullable();
            $table->string('skill5', 40)->nullable();
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
