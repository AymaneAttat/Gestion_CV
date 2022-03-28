<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->longText('profile_ids');//->unique()profile_ids
            $table->enum('delivered', ['YES', 'NO'])->default('NO');
            //$table->string('send_by');
            $table->string('date_string')->nullable();
            $table->timestamp('send_date');
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
        Schema::dropIfExists('mail_profiles');
    }
}
