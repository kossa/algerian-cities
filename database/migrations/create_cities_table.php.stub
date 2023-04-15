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
        if (Schema::hasTable('wilayas') ||  Schema::hasTable('communes')) {
            return;
        }

        Schema::create('wilayas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('arabic_name');
            $table->decimal('longitude', 9, 6);
            $table->decimal('latitude', 9, 6);
            $table->timestamps();
        });

        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('arabic_name');
            $table->string('post_code');
            $table->foreignId('wilaya_id')->constrained()->onDelete('cascade');
            $table->decimal('longitude', 9, 6);
            $table->decimal('latitude', 9, 6);
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
        Schema::dropIfExists('communes');
        Schema::dropIfExists('wilayas');
    }
};
