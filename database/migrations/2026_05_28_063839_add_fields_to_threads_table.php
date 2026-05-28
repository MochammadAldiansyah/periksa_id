<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ganti Schema::table menjadi Schema::create
        Schema::create('threads', function (Blueprint $table) {
            $table->id(); // ID Thread
            $table->string('title');
            $table->text('content');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('category');
            $table->boolean('is_pinned')->default(false);
            $table->string('status')->default('active');
            $table->integer('views_count')->default(0);
            $table->integer('reports_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};
