<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city', 20)->nullable();
            $table->string('state', 20)->nullable();
            $table->string('zip', 20)->nullable();
            $table->string('website')->nullable();
            $table->date('access_start_date')->nullable();
            $table->date('access_end_date')->nullable();
            $table->string('ip_addresses')->nullable();
            $table
                ->string('passcode')
                ->nullable()
                ->unique();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table
                ->integer('media_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();

            $table
                ->foreign('media_id')
                ->references('id')
                ->on('media')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
};
