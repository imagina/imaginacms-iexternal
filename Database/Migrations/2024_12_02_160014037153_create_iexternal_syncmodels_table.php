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
        Schema::create('iexternal__syncmodels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->string('system_name')->unique();
            $table->string('repository_path');
            $table->string('entity_path');
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
        Schema::dropIfExists('iexternal__syncmodels');
    }
};
