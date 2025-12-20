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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('teacher_id')->unique();
            $table->string('name|max:255');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender',['male', 'female', 'other']);
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->enum('status',['active', 'inactive', 'suspended']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
