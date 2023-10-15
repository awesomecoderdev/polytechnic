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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            // $table->integer("student_id")->default(0);
            $table->string("roll")->nullable();
            $table->string("gpa")->nullable();
            $table->string("failed")->nullable();
            // $table->string("reg")->nullable();
            // $table->string("session")->nullable();
            $table->enum("semester", ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"])->default("1st");
            $table->text("metadata")->nullable();
            $table->string("regulation")->nullable();
            $table->string("institute")->nullable();
            $table->timestamp("published")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
