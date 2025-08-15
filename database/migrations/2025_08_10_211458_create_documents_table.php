<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // владелец документа
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // основные поля
            $table->string('title');                 // заголовок
            $table->string('project')->nullable();   // проект/папка (как в гугл-диске)
            $table->longText('content')->nullable(); // Markdown-текст

            // индексы под быстрый поиск
            $table->index(['user_id', 'project']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
