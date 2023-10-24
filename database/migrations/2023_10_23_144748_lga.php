<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLgasTable extends Migration
{
    public function up()
    {
        Schema::create('lgas', function (Blueprint $table) {
            $table->bigIncrements('uniqueid');
            $table->integer('lga_id');
            $table->string('lga_name', 50);
            $table->integer('state_id');
            $table->text('lga_description')->nullable();
            $table->string('entered_by_user', 50);
            $table->dateTime('date_entered');
            $table->string('user_ip_address', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lgas');
    }
}
