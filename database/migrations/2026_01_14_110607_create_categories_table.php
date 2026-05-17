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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();

            // parent_id указывает на id в этой же таблице. При удалении родителя, у детей сотрется связь (set null)
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->onDelete('set null');

            $table->string('icon')->nullable();                // Иконка категории
            $table->integer('sort_order')->default(0);   // Сортировка
            $table->boolean('popular')->default(false);  // Популярная категория
            $table->boolean('is_active')->default(true); // Активна ли категория

            // SEO поля
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();

            // Индексы
            $table->index('parent_id');
            $table->index('popular');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
