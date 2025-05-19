<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("no")->unique;
            $table->string("email")->unique;
            $table->string("password");
            $table->string("IMGURL")->nullable();
            $table->boolean('Isactive')->default(1);
            $table->boolean('has graduated')->default(0);
            $table->boolean('dissmissed')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
