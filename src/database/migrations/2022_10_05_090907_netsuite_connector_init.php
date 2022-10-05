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
        Schema::create('net_suite_calls', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_parsed')->default(0);
            $table->string('method')->nullable();
            $table->string('entity_name')->nullable();
            $table->longText('entity_content')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->longText('body')->nullable();
            $table->timestampTz('remote_timestamp')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('net_suite_calls');
    }
};
