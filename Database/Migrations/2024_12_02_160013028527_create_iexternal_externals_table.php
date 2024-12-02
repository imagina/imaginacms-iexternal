<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('iexternal__externals', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your fields...
      $table->string('entity_type')->nullable();
      $table->integer('entity_id')->unsigned()->nullable();
      $table->integer('provider_id')->unsigned();
      $table->string('external_id');
      $table->foreign('provider_id')->references('id')->on('iexternal__providers')->onDelete('cascade');
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
    Schema::table('iexternal__externals', function (Blueprint $table) {
      $table->dropForeign(['provider_id']);
    });
    Schema::dropIfExists('iexternal__externals');
  }
};
