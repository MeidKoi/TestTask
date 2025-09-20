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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('active')->default(true);
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('expire_hours')
                ->comment('через какое количество часов пользователь'.
                                   'после добавления в группу должен быть исключен из группы');
        });

        Schema::create('group_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->dateTime('expired_at')->nullable();
            $table->primary(['user_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_user');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('users');
    }
};
