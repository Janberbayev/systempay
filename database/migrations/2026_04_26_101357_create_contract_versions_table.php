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
        Schema::create('contract_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deal_id')->constrained()->cascadeOnDelete();

            // версия
            $table->integer('version');

            // snapshot данных договора (ВАЖНО)
            $table->json('snapshot');

            // файл договора
            $table->string('file_path')->nullable();

            // hash для защиты от подделки
            $table->string('hash');

            // подписи
            $table->timestamp('signed_by_client_at')->nullable();
            $table->timestamp('signed_by_contractor_at')->nullable();

            // immutable
            $table->timestamp('signed_at')->nullable();   // финальный момент подписания
            $table->boolean('is_locked')->default(false); // блокировка версии

            $table->enum('status', ['draft', 'signed', 'archived'])
                ->default('draft');

            $table->timestamps();

            $table->unique(['deal_id', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_versions');
    }
};
