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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100);
            $table->string('phone',20);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('privacity', ['public', 'private'])->default('private');
            $table->enum('status',['active', 'inactive', 'pending']) -> default('inactive');
            $table->string('usuario')->nullable();
            $table->string('observaciones')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
