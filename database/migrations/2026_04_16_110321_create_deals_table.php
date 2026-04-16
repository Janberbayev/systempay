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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            // связи
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete();

            // участники
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('contractor_id')->constrained('users')->cascadeOnDelete();

            // условия сделки (фиксируем на момент выбора)
            $table->decimal('price', 10, 2);
            $table->integer('duration');

            // статус сделки
            $table->string('status', 20)->nullable();
            // active / completed / cancelled

            // ограничения
            $table->unique('project_id'); // 1 проект = 1 сделка
            $table->unique('offer_id');   // 1 offer нельзя выбрать дважды

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
