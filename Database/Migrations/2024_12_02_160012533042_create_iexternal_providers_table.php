<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iexternal__providers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->string('title');
            $table->string('description')->nullable();
            $table->longText('options')->nullable();
            $table->longText('keys')->nullable();
            $table->boolean('status')->default(1);
            // Audit fields
            $table->timestamps();
            $table->auditStamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iexternal__providers');
    }
};
