<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
        $table->id();
        $table->string('full_name');
        $table->string('email');
        $table->string('phone');
        $table->string('linkedin');
        $table->date('appointment_date');
        $table->string('photo_path')->nullable();
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
        Schema::dropIfExists('form_submissions');
    }
};
